<?php
namespace GDO\Captcha\Method;

use GDO\Captcha\Module_Captcha;
use GDO\Captcha\PhpCaptcha;
use GDO\Core\Method;
use GDO\User\GDO_Session;
use GDO\Net\HTTP;
/**
 * Create and display a captcha.
 * 
 * @author gizmore
 * @author spaceone
 * 
 * @since 2.0
 * @version 5.0
 */
class Image extends Method
{
	public function isAjax() { return true; }
	
	public function execute() 
	{
		# Load the Captcha class
		$module = Module_Captcha::instance();
		
		# disable HTTP Caching
		HTTP::noCache();
		
		# Setup Font, Color, Size
		$aFonts = $module->cfgCaptchaFonts();
		foreach ($aFonts as $i => $font) { $aFonts[$i] = GDO_PATH . "/$font"; }
		$rgbcolor = ltrim($module->cfgCaptchaBG(), '#');
		$width = $module->cfgCaptchaWidth();
		$height = $module->cfgCaptchaHeight();
		$oVisualCaptcha = new PhpCaptcha($aFonts, $width, $height, $rgbcolor);
		
		if (isset($_REQUEST['new']))
		{
			GDO_Session::remove('php_lock_captcha');
		}
		
		
		$oVisualCaptcha->Create('', GDO_Session::get('php_lock_captcha', true));
		die();
	}
}
