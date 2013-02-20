<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2013 osCommerce; http://www.oscommerce.com
 * @license GNU General Public License; http://www.oscommerce.com/gpllicense.txt
 */

  require(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'form_check.js.php');
?>

<h1><?php echo HEADING_TITLE_PASSWORD_RESET; ?></h1>

<?php
  if ($messageStack->size('password_reset') > 0) {
    echo $messageStack->output('password_reset');
  }
?>

<?php echo tep_draw_form('password_reset', tep_href_link('account', 'password&reset&process&e=' . $_GET['e'] . '&k=' . $_GET['k'], 'SSL'), 'post', 'onsubmit="return check_form(password_reset);"', true); ?>

<div class="contentContainer">
  <div class="contentText">
    <div><?php echo TEXT_MAIN_PASSWORD_RESET; ?></div>

    <table border="0" cellspacing="2" cellpadding="2" width="100%">
      <tr>
        <td class="fieldKey"><?php echo ENTRY_PASSWORD; ?></td>
        <td class="fieldValue"><?php echo tep_draw_password_field('password'); ?></td>
      </tr>
      <tr>
        <td class="fieldKey"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
        <td class="fieldValue"><?php echo tep_draw_password_field('confirmation'); ?></td>
      </tr>
    </table>
  </div>

  <div class="buttonSet">
    <span class="buttonAction"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', null, 'primary'); ?></span>
  </div>
</div>

</form>
