<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'admin/users/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/edit/' . $user->uzivatel_ID . '/?search=' . $search) ?>
<table class="form_table">
<input type="hidden" name="id" value="<?php echo $user->uzivatel_ID; ?>">
    <tr class="form_table_row">
        <td>Prihlasovacie meno:</td>
        <td><input type="text" name="login" value="<?php echo $user->login; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Meno:</td>
        <td><input type="text" name="name" value="<?php echo $user->meno; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Priezvisko:</td>
        <td><input type="text" name="surname" value="<?php echo $user->priezvisko; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>E-mail:</td>
        <td><input type="text" name="mail" value="<?php echo $user->mail; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Tel. číslo:</td>
        <td><input type="text" name="phone_number" value="<?php echo $user->tel_cislo; ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</form>
</table>
</div>
</div>
