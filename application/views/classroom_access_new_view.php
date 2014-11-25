<?php echo validation_errors(); ?>

<?php echo form_open('classroom/access/new/?search=' . $search) ?>
    Typ Prislusenstva:<input type="text" name="access_type" value="<?php echo set_value('access_type'); ?>"><br>
    Seriove cislo:<input type="text" name="access_serial_no" value="<?php echo set_value('access_serial_no'); ?>"><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/access/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
