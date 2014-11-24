<?php echo validation_errors(); ?>

<?php echo form_open('admin/grade/edit/' . $grade->rocnik_ID . '/?search=' . $search) ?>
    <input type="hidden" name="id" value="<?php echo $grade->rocnik_ID; ?>">
    Názov:<input type="text" name="name" value="<?php echo $grade->nazov; ?>"><br>
    Začiatok štúdia:<input type="text" name="start_date" value="<?php echo $grade->zaciatok_stud; ?>"><br>
    Obor:
    <select name="dep">
<?php

foreach ($deps as &$dep)
{
    echo '<option ';
    if ($dep->obor_ID == $grade->obor_ID)
        echo 'selected="selected" ';
    echo 'value="', $dep->obor_ID, '">', $dep->nazov, '</option>', PHP_EOL;
}

?>
    </select><br>
    <input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/grade/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
