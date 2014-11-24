<?php echo validation_errors(); ?>

<?php echo form_open('admin/dep/new/?search=' . $search) ?>
    Názov:<input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>
    Titul:<input type="text" name="title" value="<?php echo set_value('title'); ?>"><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/dep/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
