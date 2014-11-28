<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'classroom/typeaccess/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('classroom/typeaccess/new/?search=' . $search) ?>
<table class="form_table">
    <tr class="form_table_row">
    <td>Názov typu príslušenstva:</td>
    <td><input type="text" name="typeaccess_name" value="<?php echo set_value('typeaccess_name'); ?>"></td>
    <tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</form>
</table>
