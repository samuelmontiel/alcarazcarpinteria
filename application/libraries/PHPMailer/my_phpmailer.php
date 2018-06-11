<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
require_once('PHPMailer/class.phpmailer.php');
/**
 * 
 */
class MY_PHPMailer extends PHPMailer
{
	
	public function __construct()
	{
		parent::__construct();
	}
}
?>