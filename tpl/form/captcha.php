<?php /** @var $field GDO\Captcha\GDT_Captcha **/ ?>
<div class="gdo-container<?= $field->classError(); ?>">
  <label for="form[<?= $field->name; ?>]"><?= t('captcha'); ?></label>
  <?= $field->htmlIcon(); ?>
  <input
   class="ib"
   autocomplete="off"
   type="text"
   pattern="[a-zA-Z]{5}"
   size="5"
   required="required"
   name="form[<?= $field->name; ?>]"
   value="<?= $field->displayVar(); ?>" />
  <img
   class="ib gdo-captcha-img"
   src="<?= $field->hrefCaptcha(); ?>"
   onclick="this.src='<?= $field->hrefNewCaptcha(); ?>'+(new Date().getTime())" />
  <div class="gdo-form-error"><?= $field->error; ?></div>
</div>
