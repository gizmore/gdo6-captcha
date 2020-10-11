<?php
namespace GDO\Captcha;

use GDO\Form\GDT_Form;
use GDO\Core\GDT;
use GDO\User\GDO_Session;
use GDO\Core\GDT_Template;
use GDO\UI\WithIcon;
use GDO\DB\GDT_String;

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
		$this->initial = GDO_Session::get('php_lock_captcha', '');
	}
	
	public function hrefCaptcha()
	{
		return "index.php?mo=Captcha&me=Image&ajax=1";
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
		$stored = GDO_Session::get('php_captcha', null);
		if (strtoupper($value) === $stored)
		{
			GDO_Session::set('php_lock_captcha', $value);
			return true;
		}
		$this->invalidate();
		return $this->error('err_captcha');
	}
	
	public function invalidate()
	{
		GDO_Session::remove('php_lock_captcha');
		unset($_POST[$this->formVariable()][$this->name]);
		unset($_REQUEST[$this->formVariable()][$this->name]);
	}
	
	public function onValidated()
	{
		$this->invalidate();
	}
	
}
