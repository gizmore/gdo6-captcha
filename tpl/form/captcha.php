<?php
/** @var $field \GDO\Captcha\GDT_Captcha **/
use GDO\Core\GDT_Template;

?>
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
  <?= GDT_Template::php('Captcha', 'form/captcha_inner.php', ['field' => $field])?>
  <?= $field->htmlError(); ?>
</div>
