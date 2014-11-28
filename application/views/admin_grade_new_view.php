<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form style="display: inline;" action="<?php echo site_url(), 'admin/grade/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/grade/new/?search=' . $search) ?>
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Názov:</td>
        <td><input type="text" name="name" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Začiatok štúdia:</td>
        <td><input type="text" name="start_date" value="<?php echo set_value('start_date'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Obor:</td>
        <td>
            <select name="dep">
                <?php

                foreach ($deps as &$dep)
                {
                    echo '<option value="', $dep->obor_ID, '">', $dep->nazov, '</option>', PHP_EOL;
                }

                ?>
            </select>
        </td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</table>
</form>
<div class="req_hint">
    <span class="hint">Povinné položky sú označené hrubým písmom</span>
</div>

</div>
</div>

