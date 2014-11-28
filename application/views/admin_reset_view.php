<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/reset'); ?>
<input type="hidden" name="reset_request" value="1">
<table class="form_table">
    <tr class="form_table_row">
        <td>Reset celej databazy:</td>
        <td><input type="checkbox" name="reset_db" value="1"></td>
    </tr>
    <tr class="form_table_row">
        <td>Reset uživateľov:</td>
        <td><input type="checkbox" name="reset_users" value="1"></td>
    </tr>
    <tr class="form_table_row">
        <td>Reset akcií:</td>
        <td><input type="checkbox" name="reset_actions" value="1"></td>
    </tr>
    <tr class="form_table_row">
        <td>Reset učební:</td>
        <td><input type="checkbox" name="reset_rooms"value="1"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" value="Obnoviť"></td></tr>
</table>
</form>

</div>
</div>
