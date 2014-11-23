<?php echo validation_errors(); ?>

<?php echo form_open('login'); ?>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="login_request" value="Login"><br>
</form>
