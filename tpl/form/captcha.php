<?php /** @var $field GDO\Captcha\GDT_Captcha **/ ?>
<div class="gdo-container<?= $field->classError(); ?>">
  <?= $field->htmlIcon(); ?>
  <label <?=$field->htmlForID()?>><?= t('captcha'); ?></label>
  <input
   <?=$field->htmlID()?>
   class="ib"
   autocomplete="off"
   type="text"
   pattern="[a-zA-Z]{5}"
   size="5"
   required="required"
   <?=$field->htmlFormName()?>
   value="<?= $field->displayVar(); ?>" />
  <img
   class="ib gdo-captcha-img"
   src="<?= $field->hrefCaptcha(); ?>"
   onclick="this.src='<?= $field->hrefNewCaptcha(); ?>'+(new Date().getTime())" />
  <?= $field->htmlError(); ?>
</div>
