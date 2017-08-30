<?php
namespace GDO\Captcha;

use GDO\Form\GDT_Form;
use GDO\Type\GDT_Base;
use GDO\User\GDO_Session;
use GDO\Template\GDT_Template;
use GDO\Form\WithIcon;

class GDT_Captcha extends GDT_Base
{
    use WithIcon;
    public $notNull = true;
    
	public function blankData() {}
	public function addFormValue(GDT_Form $form, $value) {}
	
	public function __construct()
	{
		$this->name = 'captcha';
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
		if (strtoupper($value) === GDO_Session::get('php_captcha', null))
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
	}
	
	public function onValidated()
	{
	    $this->invalidate();
	}
	
}
