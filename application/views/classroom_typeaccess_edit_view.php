<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'classroom/typeaccess'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('classroom/typeaccess/edit/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search) ?>
<table class="form_table">
<input type="hidden" name="id" value="<?php echo $typeaccess->typ_prislusenstva_ID; ?>">
    <tr class="form_table_row">
        <td>Nazov typu prislusenstva:</td>
        <td><input type="text" name="typeaccess_name" value="<?php echo $typeaccess->nazov_typu; ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</form>
</table>
</div>
</div>
