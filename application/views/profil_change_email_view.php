<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'profil/change_email'; ?>">
    <input type="hidden" name="change_email_request" value="1">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('profil/change_email'); ?>
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Zadajte nový e-mail:</td>
        <td><input type="text" name="mail"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Heslo:</td>
        <td><input type="password" name="confirm_passwd"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="change_email_request" value="Zmeniť E-mail"></td></tr>
</table>
</form>
<div class="req_hint">
    <span class="hint">Povinné položky sú označené hrubým písmom</span>
</div>

</div>
</div>
