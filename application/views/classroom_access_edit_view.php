<?php echo validation_errors(); ?>

<?php echo form_open('classroom/access/edit/' . $access->prislusenstvo_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $access->prislusenstvo_ID; ?>">
Typ Prislusenstva:
<select name="access_type">
<?php

foreach ($typeaccesses as &$typeaccess)
{
    echo '<option ';
    if ($typeaccess->typ_prislusenstva_ID == $access->typ_ID)
        echo 'selected="selected" ';
    echo '<option value="', $typeaccess->typ_prislusenstva_ID, '">', $typeaccess->nazov_typu, '</option>', PHP_EOL;
}

?>
    </select><br>
Seriove cislo:<input type="text" name="access_serial_no" value="<?php echo $access->seriove_cislo; ?>"><br>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/access/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
