<?php echo validation_errors(); ?>

<?php echo form_open('admin/subject/edit/' . $subject->predmet_ID . '/?search=' . $search) ?>
    <input type="hidden" name="id" value="<?php echo $subject->predmet_ID; ?>">
    Názov:<input type="text" name="name" value="<?php echo $subject->nazov_predmetu; ?>"><br>
    Kredity:<input type="text" name="credits" value="<?php echo $subject->kredity; ?>"><br>
    Garant:
    <select name="garant">
    <option value="<?php echo login_data('id'); ?>">(ja)</option>
<?php

foreach ($users as &$user)
{
    echo '<option ';
    if ($user->uzivatel_ID == $subject->garant_ID)
        echo ' selected="selected"';
    echo 'value="', $user->uzivatel_ID, '">', $user->login, '</option>', PHP_EOL;
}

?>
    </select><br>
    Ročník:
    <select name="grade">
<?php

foreach ($grades as &$grade)
{
    echo '<option ';
    if ($grade->rocnik_ID == $subject->rocnik_ID)
        echo ' selected="selected"';
    echo 'value="', $grade->rocnik_ID, '">', $grade->nazov, '</option>', PHP_EOL;
}

?>
    </select><br>
    <input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'admin/subject/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>



