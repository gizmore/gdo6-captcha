<?php
namespace GDO\Captcha\Method;

use GDO\Captcha\Module_Captcha;
use GDO\Captcha\PhpCaptcha;
use GDO\Session\GDO_Session;
use GDO\Net\HTTP;
use GDO\Core\MethodAjax;

/**
 * Create and display a captcha.
 * 
 * @author gizmore
 * @author spaceone
 * 
 * @since 2.0
 * @version 5.0
 */
class Image extends MethodAjax
{
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
		    GDO_Session::remove('php_captcha');
		    GDO_Session::remove('php_captcha_lock');
		    GDO_Session::commit();
		}
		
		$challenge = GDO_Session::get('php_captcha_lock', true);
		$oVisualCaptcha->Create('', $challenge);
		die();
	}
	
}
