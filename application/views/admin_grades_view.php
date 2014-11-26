<a href="<?php echo site_url(), 'admin/grade/new/?search=', $search; ?>">Pridať ročník</a><br>

<form method="get" action="<?php echo site_url(); ?>admin/grade/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($grades as &$grade)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $grade->nazov, '</td>', PHP_EOL;
    echo '<td>', $grade->zaciatok_stud, '</td>', PHP_EOL;
    echo '<td>', $grade->obor, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/grade/edit/' . $grade->rocnik_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/grade/delete/' . $grade->rocnik_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
