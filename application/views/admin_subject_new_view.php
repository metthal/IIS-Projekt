<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form style="display: inline;" action="<?php echo site_url(), 'admin/subject/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/subject/new/?search=' . $search) ?>
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Názov:</td>
        <td><input type="text" name="name" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Kredity:</td>
        <td><input type="text" name="credits" value="<?php echo set_value('credits'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Garant:</td>
        <td>
            <select name="garant">
            <option selected="selected" value="<?php echo login_data('id'); ?>">(ja)</option>
        <?php

        foreach ($users as &$user)
        {
            echo '<option value="', $user->uzivatel_ID, '">', $user->login, '</option>', PHP_EOL;
        }

        ?>
            </select>
        </td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Ročník:</td>
        <td>
            <select name="grade">
        <?php

        foreach ($grades as &$grade)
        {
            echo '<option value="', $grade->rocnik_ID, '">', $grade->nazov, '</option>', PHP_EOL;
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

