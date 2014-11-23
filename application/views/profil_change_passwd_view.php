<?php echo validation_errors(); ?>

<?php echo form_open('profil/change_passwd'); ?>
    <input type="hidden" name="change_passwd_request" value="1">
    Staré heslo: <input type="password" name="old_passwd"><br>
    Nové heslo: <input type="password" name="new_passwd"><br>
    Potrvdenie nového hesla: <input type="password" name="confirm_passwd"><br>
    <input type="submit" name="change_passwd_request" value="Change password"><br>
</form>
