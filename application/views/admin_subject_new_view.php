<?php echo validation_errors(); ?>

<?php echo form_open('admin/subject/new/?search=' . $search) ?>
    Názov:<input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>
    Kredity:<input type="text" name="credits" value="<?php echo set_value('credits'); ?>"><br>
    Garant:
    <select name="garant">
    <option selected="selected" value="<?php echo login_data('id'); ?>">(ja)</option>
<?php

foreach ($users as &$user)
{
    echo '<option value="', $user->uzivatel_ID, '">', $user->login, '</option>', PHP_EOL;
}

?>
    </select><br>
    Ročník:
    <select name="grade">
<?php

foreach ($grades as &$grade)
{
    echo '<option value="', $grade->rocnik_ID, '">', $grade->nazov, '</option>', PHP_EOL;
}

?>
    </select><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/subject/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>


