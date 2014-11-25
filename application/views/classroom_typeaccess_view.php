<a href="<?php echo site_url(), 'classroom/typeaccess/new/?search=', $search; ?>">Pridať typ prislusenstva</a><br>

<form method="get" action="<?php echo site_url(); ?>classroom/typeaccess/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($typeacceses as &$typeaccess)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $typeaccess->nazov_typu, '</td>', PHP_EOL;
    $edit_url = site_url() . 'classroom/typeaccess/edit/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search;
    $delete_url = site_url() . 'classroom/typeaccess/delete/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
