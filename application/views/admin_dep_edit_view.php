<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'admin/dep/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>
</div>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/dep/edit/' . $dep->obor_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $dep->obor_ID; ?>">
<table class="form_table">
    <tr class="form_table_row">
        <td>Názov:</td>
        <td><input type="text" name="name" value="<?php echo $dep->nazov; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Titul:</td>
        <td><input type="text" name="title" value="<?php echo $dep->titul; ?>"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</table>
</form>

</div>
</div>
