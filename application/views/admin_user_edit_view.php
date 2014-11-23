<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/edit/' . $user->uzivatel_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $user->uzivatel_ID; ?>">
Prihlasovacie meno:<input type="text" name="login" value="<?php echo $user->login; ?>"><br>
Meno:<input type="text" name="name" value="<?php echo $user->meno; ?>"><br>
Priezvisko:<input type="text" name="surname" value="<?php echo $user->priezvisko; ?>"><br>
E-mail:<input type="text" name="mail" value="<?php echo $user->mail; ?>"><br>
Tel. číslo:<input type="text" name="phone_number" value="<?php echo $user->tel_cislo; ?>"><br>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/users/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
