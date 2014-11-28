</div>
<div class="content">
<div class="content_wrapper">
<?php echo validation_errors(); ?>

<?php echo form_open('login'); ?>
<table class="form_table" style="margin-top: 15px">
    <tr class="form_table_row">
        <td>Prihlasovacie meno:</td>
        <td><input type="text" name="username"></td>
    </tr>
    <tr class="form_table_row">
        <td>Heslo:</td>
        <td><input type="password" name="password"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="login_request" value="Login"></td></tr>
</table>
</form>
</div>
</div>
