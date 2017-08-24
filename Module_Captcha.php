<?php
namespace GDO\Captcha;

use GDO\Core\Module;
use GDO\Type\GDO_Int;
use GDO\UI\GDO_Color;
use GDO\UI\GDO_Font;

final class Module_Captcha extends Module
{
	public function onLoadLanguage() { return $this->loadLanguage('lang/captcha'); }
	public function getConfig()
	{
		return array(
		    GDO_Font::make('captcha_font')->multiple()->minSelected(1)->initialValue(["theme/default/fonts/arial.ttf"])->notNull(),
			GDO_Color::make('captcha_bg')->initial('#f8f8f8')->notNull(),
			GDO_Int::make('captcha_width')->initial('256')->min(48)->max(512)->notNull(),
			GDO_Int::make('captcha_height')->initial('48')->min(24)->max(256)->notNull(),
		);
	}
	public function cfgCaptchaFonts() { return $this->getConfigValue('captcha_font'); }
	public function cfgCaptchaBG() { return $this->getConfigValue('captcha_bg'); }
	public function cfgCaptchaWidth() { return $this->getConfigValue('captcha_width'); }
	public function cfgCaptchaHeight() { return $this->getConfigValue('captcha_height'); }
}
