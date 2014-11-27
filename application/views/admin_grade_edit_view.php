<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form style="display: inline;" action="<?php echo site_url(), 'admin/grade/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>
<?php echo validation_errors(); ?>

<table class="form_table">
<?php echo form_open('admin/grade/edit/' . $grade->rocnik_ID . '/?search=' . $search) ?>
    <input type="hidden" name="id" value="<?php echo $grade->rocnik_ID; ?>">
    <tr class="form_table_row">
        <td>Názov:</td>
        <td><input type="text" name="name" value="<?php echo $grade->nazov; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Začiatok štúdia:</td>
        <td><input type="text" name="start_date" value="<?php echo $grade->zaciatok_stud; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Obor:</td>
        <td>
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
            </select>
        </td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</form>
</table>

</div>
</div>
