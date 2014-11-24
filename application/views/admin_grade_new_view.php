<?php echo validation_errors(); ?>

<?php echo form_open('admin/grade/new/?search=' . $search) ?>
    Názov:<input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>
    Začiatok štúdia:<input type="text" name="start_date" value="<?php echo set_value('start_date'); ?>"><br>
    Obor:
    <select name="dep">
<?php

foreach ($deps as &$dep)
{
    echo '<option value="', $dep->obor_ID, '">', $dep->nazov, '</option>', PHP_EOL;
}

?>
    </select><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/grade/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>

