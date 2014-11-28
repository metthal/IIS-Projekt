<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'admin/users/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/new/?search=' . $search) ?>
<table class="form_table">
    <tr class="form_table_row">
        <td>Prihlasovacie meno:</td>
        <td><input type="text" name="login" value="<?php echo set_value('login'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Heslo:</td>
        <td><input type="password" name="password"></td>
    </tr>
    <tr class="form_table_row">
        <td>Meno:</td>
        <td><input type="text" name="name" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Priezvisko:</td>
        <td><input type="text" name="surname" value="<?php echo set_value('surname'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>E-mail:</td>
        <td><input type="text" name="mail" value="<?php echo set_value('mail'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Tel. číslo:</td>
        <td><input type="text" name="phone_number" value="<?php echo set_value('phone_number'); ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</table>
</form>

</div>
</div>
