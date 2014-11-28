<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'classroom/access'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('classroom/access/new/?search=' . $search) ?>
<table class="form_table">
    <tr class="form_table_row">
        <td>Typ príslušenstvo:</td>
        <td><select name="access_type">
<?php
foreach ($typeaccesses as &$typeaccess)
    echo '<option value="', $typeaccess->typ_prislusenstva_ID, '">', $typeaccess->nazov_typu, '</option>', PHP_EOL;
?>
    </select></td>
    </tr>
    <tr class="form_table_row">
        <td>Sériové číslo:</td>
        <td><input type="text" name="access_serial_no" value="<?php echo set_value('access_serial_no'); ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</table>
</form>

</div>
</div>
