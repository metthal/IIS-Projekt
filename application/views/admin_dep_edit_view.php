<?php echo validation_errors(); ?>

<?php echo form_open('admin/dep/edit/' . $dep->obor_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $dep->obor_ID; ?>">
Názov:<input type="text" name="name" value="<?php echo $dep->nazov; ?>"><br>
Titul:<input type="text" name="title" value="<?php echo $dep->titul; ?>"><br>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/dep/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
