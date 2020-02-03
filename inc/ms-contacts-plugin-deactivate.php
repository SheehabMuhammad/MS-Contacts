<?php
/**
 *
 * @link              https://www.sheehab.com/ms-contact
 * @since             1.0.0
 * @package           Client
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}

global $ms_contacts_version;

/**
 * 
 */
class MS_Contacts_Deactivate
{

	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}