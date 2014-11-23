<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/new/?search=' . $search) ?>
    Prihlasovacie meno:<input type="text" name="login" value="<?php echo set_value('login'); ?>"><br>
    Heslo:<input type="password" name="password"><br>
    Meno:<input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>
    Priezvisko:<input type="text" name="surname" value="<?php echo set_value('surname'); ?>"><br>
    E-mail:<input type="text" name="mail" value="<?php echo set_value('mail'); ?>"><br>
    Tel. číslo:<input type="text" name="phone_number" value="<?php echo set_value('phone_number'); ?>"><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/users/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
