<?php echo validation_errors(); ?>

<?php echo form_open('admin/reset'); ?>
    <input type="hidden" name="reset_request" value="1">
    Reset celej databazy: <input type="checkbox" name="reset_db" value="1"><br>
    Reset uživateľov: <input type="checkbox" name="reset_users" value="1"><br>
    Reset akcií: <input type="checkbox" name="reset_actions" value="1"><br>
    Reset učební: <input type="checkbox" name="reset_rooms"value="1"><br>
    <input type="submit" value="Reset"><br>
</form>
