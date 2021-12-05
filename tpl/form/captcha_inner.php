<?php
use GDO\Captcha\GDT_Captcha;
/** @var $field GDT_Captcha **/
?>
<span>
  <input
   <?=$field->htmlID()?>
   class="ib form-control"
   autocomplete="off"
   type="text"
   pattern="[a-zA-Z]{5}"
   size="5"
   required="required"
   <?=$field->htmlFormName()?>
   value="<?= $field->display(); ?>" />
  <img class="ib gdo-captcha-img" src="<?= $field->hrefCaptcha(); ?>"
   alt="Captcha" onclick="this.src='<?= $field->hrefNewCaptcha(); ?>'+(new Date().getTime())" />
</span>
