<?php echo validation_errors(); ?>

<?php echo form_open('classroom/typeaccess/new/?search=' . $search) ?>
    Nazov typu prislusenstva:<input type="text" name="typeaccess_name" value="<?php echo set_value('typeaccess_name'); ?>"><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/typeaccess/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
