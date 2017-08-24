<?php
namespace GDO\Captcha;

use GDO\Form\GDO_Form;
use GDO\Type\GDO_Base;
use GDO\User\Session;
use GDO\Template\GDO_Template;
use GDO\Form\WithIcon;

class GDO_Captcha extends GDO_Base
{
    use WithIcon;
    
	public function blankData() {}
	public function addFormValue(GDO_Form $form, $value) {}
	
	public function __construct()
	{
		$this->name = 'captcha';
		$this->initial = Session::get('php_lock_captcha', '');
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
		return GDO_Template::php('Captcha', 'form/captcha.php', ['field' => $this]);
	}
	
	public function validate($value)
	{
		if (strtoupper($value) === Session::get('php_captcha', null))
		{
			Session::set('php_lock_captcha', $value);
			return true;
		}
		$this->invalidate();
		return $this->error('err_captcha');
	}
	
	public function invalidate()
	{
		Session::remove('php_lock_captcha');
	}
	
	public function onValidated()
	{
	    $this->invalidate();
	}
	
}
