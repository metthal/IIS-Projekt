<?php echo validation_errors(); ?>

<?php echo form_open('classroom/typeaccess/edit/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $typeaccess->typ_prislusenstva_ID; ?>">
Nazov typu prislusenstva:<input type="text" name="typeaccess_name" value="<?php echo $typeaccess->nazov_typu; ?>"><br>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/typeaccess/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
