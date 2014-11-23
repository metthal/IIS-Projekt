<?php echo validation_errors(); ?>

<?php echo form_open('profil/change_email'); ?>
    <input type="hidden" name="change_email_request" value="1">
    Zadajte novy e-mail: <input type="text" name="email"><br>
    Heslo: <input type="password" name="confirm_passwd"><br>
    <input type="submit" name="change_email_request" value="Change E-mail"><br>
</form>
