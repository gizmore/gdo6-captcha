<?php
namespace GDO\Captcha;

use GDO\Form\GDT_Form;
use GDO\Session\GDO_Session;
use GDO\Core\GDT_Template;
use GDO\UI\WithIcon;
use GDO\DB\GDT_String;

/**
 * Very basic captcha and easy to solve.
 * 
 * @author gizmore
 * @version 6.10
 * @since 3.04
 */
class GDT_Captcha extends GDT_String
{
	use WithIcon;
	
	public $notNull = true;
	
	public function addFormValue(GDT_Form $form, $value) {}
	
	public function __construct()
	{
		$this->name = 'captcha';
		$this->icon('captcha');
		$this->tooltip(t('tt_captcha'));
		$this->initial = GDO_Session::get('php_captcha_lock');
	}
	
	public function hrefCaptcha()
	{
	    $href = "index.php?mo=Captcha&me=Image&ajax=1";
	    if ($code = GDO_Session::get('php_captcha_lock'))
	    {
	        $href .= "&old={$code}";
	    }
	    return $href;
	}
	
	public function hrefNewCaptcha()
	{
		return "index.php?mo=Captcha&me=Image&ajax=1&new=1";
	}

	public function renderForm()
	{
		return GDT_Template::php('Captcha', 'form/captcha.php', ['field' => $this]);
	}
	
	public function validate($value)
	{
		$stored = GDO_Session::get('php_captcha');
		if (strtoupper($value) === strtoupper($stored))
		{
		    GDO_Session::set('php_captcha_lock', strtoupper($value));
			return true;
		}
		return $this->invalidate();
	}
	
	public function invalidate()
	{
	    GDO_Session::remove('php_captcha');
	    GDO_Session::remove('php_captcha_lock');
	    unset($_POST[$this->formVariable()][$this->name]);
		unset($_REQUEST[$this->formVariable()][$this->name]);
		$this->initial = null;
		return $this->error('err_captcha');
	}
	
}
