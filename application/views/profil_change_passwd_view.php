<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'profil/change_passwd'; ?>">
    <input type="hidden" name="change_passwd_request" value="1">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('profil/change_passwd'); ?>
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Staré heslo:</td>
        <td><input type="password" name="old_passwd"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Nové heslo:</td>
        <td> <input type="password" name="new_passwd"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Potrvdenie nového hesla:</td>
        <td> <input type="password" name="confirm_passwd"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="change_passwd_request" value="Zmeniť heslo"></td></tr>
</table>
</form>
<div class="req_hint">
    <span class="hint">Povinné položky sú označené hrubým písmom</span>
</div>

</div>
</div>
