<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'classroom/access'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('classroom/access/edit/' . $access->prislusenstvo_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $access->prislusenstvo_ID; ?>">
<table class="form_table">
     <tr class="form_table_row">
        <td>Typ Príslušenstva:</td>
        <td><select name="access_type">
<?php

foreach ($typeaccesses as &$typeaccess)
{
    echo '<option ';
    if ($typeaccess->typ_prislusenstva_ID == $access->typ_ID)
        echo 'selected="selected" ';
    echo '<option value="', $typeaccess->typ_prislusenstva_ID, '">', $typeaccess->nazov_typu, '</option>', PHP_EOL;
}
?>
    </select></td>
    </tr>
    <tr class="form_table_row">
        <td>Seriové číslo:</td>
        <td><input type="text" name="access_serial_no" value="<?php echo $access->seriove_cislo; ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</table>
</form>

</div>
</div>
