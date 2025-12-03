<?php

class lang{
	private $db = null;
    function __construct()
    {
        $this->db = new sql_query();
    }
	
	function langGet($data)
	{
		$language = $data["lang"];
		$langFile = parse_ini_file("../../lang/lang.ini", true);
		
		$resp["message"] = $langFile[$language];
		$resp["status"] = true; 
		
		return $resp;
		
	}
	
}

?>
