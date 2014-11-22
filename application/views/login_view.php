<?php echo validation_errors(); ?>

<?php echo form_open('login'); ?>
    <input type="hidden" name="login_request" value="1">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login"><br>
</form>
