<a href="<?php echo site_url(), 'admin/subject/new/?search=', $search; ?>">Pridať predmet</a><br>

<form method="get" action="<?php echo site_url(); ?>admin/subject/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($subjects as &$subject)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $subject->nazov_predmetu, '</td>', PHP_EOL;
    echo '<td>', $subject->kredity, '</td>', PHP_EOL;
    echo '<td>', $subject->rocnik, '</td>', PHP_EOL;
    echo '<td>', $subject->garant, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/subject/edit/' . $subject->predmet_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/subject/delete/' . $subject->predmet_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>

