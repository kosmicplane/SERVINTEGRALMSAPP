<?php
require_once __DIR__ . '/authorization.php';

class quotes
{
    private $db;
    private $auth;

    public function __construct()
    {
        $this->db = new sql_query();
        $this->auth = new Authorization();
    }

    private function normalizeContext($context)
    {
        if (is_array($context)) {
            return $context;
        }

        if (is_object($context)) {
            return (array) $context;
        }

        return [];
    }

    private function authorizeQuotePermission(string $permission, $context = [])
    {
        $contextData = $this->normalizeContext($context);
        $user = $this->auth->resolveUser(['data' => $contextData]);
        $this->auth->authorizePermission($permission, $user);
    }

    private function buildQuoteCode($clientCode, $date)
    {
        return md5($clientCode.$date);
    }

    public function createQuote($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $date = $info["date"];
        $code = $this->buildQuoteCode($info["clientCode"], $date);
        $status = "draft";
        $total = $this->calculateTotal($info["items"]);
        $internalTotal = $this->calculateInternalTotal($info);

        $str = "INSERT INTO quotes (CODE, DATE, CLIENTCODE, CLIENTNAME, SUCUCODE, SUCUNAME, CONTACT, VALIDUNTIL, STATUS, TOTAL, CURRENCY, NOTES, CREATEDBY, CREATEDBYCODE, INTERNAL_COST_TOTAL) VALUES ('".$code."', '".$date."', '".$info["clientCode"]."', '".$info["clientName"]."', '".$info["sucuCode"]."', '".$info["sucuName"]."', '".$info["contact"]."', '".$info["validUntil"]."', '".$status."', '".$total."', '".$info["currency"]."', '".$info["notes"]."', '".$info["autor"]."', '".$info["autorCode"]."', '".$internalTotal."')";
        $this->db->query($str);

        $this->saveItems($code, $info["items"]);
        $this->saveInternalCosts($code, $info);
        $this->addHistory($code, $status, "Borrador creado", $info);

        $resp["message"] = array("code" => $code, "status" => $status, "total" => $total);
        $resp["status"] = true;
        return $resp;
    }

    public function updateQuote($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $code = $info["code"];
        $status = $info["status"];
        $total = $this->calculateTotal($info["items"]);
        $internalTotal = $this->calculateInternalTotal($info);

        $str = "UPDATE quotes SET CLIENTCODE='".$info["clientCode"]."', CLIENTNAME='".$info["clientName"]."', SUCUCODE='".$info["sucuCode"]."', SUCUNAME='".$info["sucuName"]."', CONTACT='".$info["contact"]."', VALIDUNTIL='".$info["validUntil"]."', STATUS='".$status."', TOTAL='".$total."', CURRENCY='".$info["currency"]."', NOTES='".$info["notes"]."', INTERNAL_COST_TOTAL='".$internalTotal."' WHERE CODE='".$code."'";
        $this->db->query($str);

        $this->deleteItems($code);
        $this->saveItems($code, $info["items"]);

        $this->deleteInternalCosts($code);
        $this->saveInternalCosts($code, $info);

        $this->addHistory($code, $status, "Actualización de cotización", $info);

        $resp["message"] = array("code" => $code, "status" => $status, "total" => $total);
        $resp["status"] = true;
        return $resp;
    }

    public function sendQuote($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $code = $info["code"];
        $date = $info["date"];
        $str = "UPDATE quotes SET STATUS='sent', SENT_AT='".$date."' WHERE CODE='".$code."'";
        $this->db->query($str);
        $this->addHistory($code, "sent", $info["comment"], $info);

        $resp["message"] = array("code" => $code, "status" => "sent");
        $resp["status"] = true;
        return $resp;
    }

    public function approveQuote($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $code = $info["code"];
        $date = $info["date"];
        $orderCode = $this->createOrderFromQuote($code, $info);

        $str = "UPDATE quotes SET STATUS='approved', APPROVED_AT='".$date."', ORDERCODE='".$orderCode."' WHERE CODE='".$code."'";
        $this->db->query($str);
        $this->addHistory($code, "approved", $info["comment"], $info);

        $resp["message"] = array("code" => $code, "status" => "approved", "orderCode" => $orderCode);
        $resp["status"] = true;
        return $resp;
    }

    public function rejectQuote($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $code = $info["code"];
        $str = "UPDATE quotes SET STATUS='rejected' WHERE CODE='".$code."'";
        $this->db->query($str);
        $this->addHistory($code, "rejected", $info["comment"], $info);

        $resp["message"] = array("code" => $code, "status" => "rejected");
        $resp["status"] = true;
        return $resp;
    }

    public function getCatalog($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $str = "SELECT CODE, NAME, TYPE, INVENTORY_CODE, UNIT, DEFAULT_PRICE FROM catalog_items WHERE STATUS = 1 ORDER BY NAME ASC";
        $query = $this->db->query($str);

        $resp["message"] = $query;
        $resp["status"] = true;
        return $resp;
    }

    public function getClientsForQuotes($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $str = "SELECT CODE, CNAME FROM users WHERE TYPE = 'C' AND STATUS = '1' ORDER BY CNAME ASC";
        $query = $this->db->query($str);

        $resp["message"] = $query;
        $resp["status"] = true;
        return $resp;
    }

    public function getBranchesForClient($info)
    {
        $this->authorizeQuotePermission('quotes.manage', $info);
        $context = $this->normalizeContext($info);
        $clientCode = isset($context['clientCode']) ? $context['clientCode'] : '';

        $where = "WHERE STATUS = 1";
        $params = array();
        if ($clientCode !== '') {
            $where .= " AND PARENTCODE = :parent";
            $params[':parent'] = $clientCode;
        }

        $str = "SELECT CODE, NAME, PARENTCODE, PARENTNAME FROM sucus {$where} ORDER BY NAME ASC";
        $query = $this->db->executePrepared($str, $params);

        $resp["message"] = $query;
        $resp["status"] = true;
        return $resp;
    }

    private function calculateTotal($items)
    {
        $sum = 0;
        if(is_array($items))
        {
            foreach($items as $item)
            {
                $line = floatval($item["qty"]) * floatval($item["unitPrice"]);
                $line += $line * floatval($item["tax"]) / 100;
                $sum += $line;
            }
        }
        return $sum;
    }

    private function calculateInternalTotal($info)
    {
        $sum = 0;
        if(isset($info["internalCosts"]) && is_array($info["internalCosts"]))
        {
            foreach($info["internalCosts"] as $cost)
            {
                $sum += floatval($cost["amount"]);
            }
        }
        return $sum;
    }

    private function saveItems($code, $items)
    {
        if(!is_array($items))
        {
            return;
        }

        foreach($items as $item)
        {
            $total = (floatval($item["qty"]) * floatval($item["unitPrice"])) + ((floatval($item["qty"]) * floatval($item["unitPrice"])) * floatval($item["tax"]) / 100);
            $str = "INSERT INTO quote_items (QUOTE_CODE, ITEM_CODE, ITEM_DESC, ITEM_TYPE, QTY, UNIT_PRICE, TAX, TOTAL, INVENTORY_CODE) VALUES ('".$code."', '".$item["code"]."', '".$item["desc"]."', '".$item["type"]."', '".$item["qty"]."', '".$item["unitPrice"]."', '".$item["tax"]."', '".$total."', '".$item["inventoryCode"]."')";
            $this->db->query($str);
        }
    }

    private function deleteItems($code)
    {
        $str = "DELETE FROM quote_items WHERE QUOTE_CODE='".$code."'";
        $this->db->query($str);
    }

    private function saveInternalCosts($code, $info)
    {
        if(!isset($info["internalCosts"]) || !is_array($info["internalCosts"]))
        {
            return;
        }
        foreach($info["internalCosts"] as $cost)
        {
            $str = "INSERT INTO quote_internal_costs (QUOTE_CODE, COST_TYPE, AMOUNT, NOTE) VALUES ('".$code."', '".$cost["type"]."', '".$cost["amount"]."', '".$cost["note"]."')";
            $this->db->query($str);
        }
    }

    private function deleteInternalCosts($code)
    {
        $str = "DELETE FROM quote_internal_costs WHERE QUOTE_CODE='".$code."'";
        $this->db->query($str);
    }

    private function addHistory($code, $status, $comment, $info)
    {
        $str = "INSERT INTO quote_status_history (QUOTE_CODE, STATUS, COMMENT, CHANGED_BY, CHANGED_BY_CODE) VALUES ('".$code."', '".$status."', '".$comment."', '".$info["autor"]."', '".$info["autorCode"]."')";
        $this->db->query($str);
    }

    private function createOrderFromQuote($quoteCode, $info)
    {
        $str = "SELECT * FROM quotes WHERE CODE='".$quoteCode."'";
        $quoteQuery = $this->db->query($str);
        if(count($quoteQuery) == 0)
        {
            throw new Exception("Cotización no encontrada");
        }
        $quote = $quoteQuery[0];

        $orderCode = md5($quoteCode.$info["date"]);
        $date = $info["date"];
        $autor = $info["autor"];
        $autorCode = $info["autorCode"];
        $parentCode = $quote["CLIENTCODE"];
        $parentName = $quote["CLIENTNAME"];
        $sucuCode = $quote["SUCUCODE"];
        $sucuName = $quote["SUCUNAME"];
        $contact = $quote["CONTACT"];
        $detail = $quote["NOTES"];

        $str = "INSERT INTO orders (CODE, DATE, PARENTCODE, PARENTNAME, SUCUCODE, SUCUNAME, MAQUIS, STATE, STATUS, STARTIME, ENDTIME, OBSERVATIONS, PENDINGS, RECOMENDATIONS, AUTOR, AUTORCODE, DETAIL, ICODE, JZCODE, LOCATION, CONTACT, QUOTECODE) VALUES ('".$orderCode."', '".$date."', '".$parentCode."', '".$parentName."', '".$sucuCode."', '".$sucuName."', '', '1', '1', '', '', '', '', '', '".$autor."', '".$autorCode."', '".$detail."', '', '', '', '".$contact."', '".$quoteCode."')";
        $this->db->query($str);

        return $orderCode;
    }
}
?>
