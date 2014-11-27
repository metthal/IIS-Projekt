<a href="<?php echo site_url(), 'classroom/access/new/?search=', $search; ?>">Pridať Prislusenstvo</a><br>

<form method="get" action="<?php echo site_url(); ?>classroom/access/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($accesss as &$access)
{
    echo '<td>', $this->typeaccess_model->typeaccess_name($access->typ_ID)->nazov_typu, '</td>', PHP_EOL;
    echo '<td>', $access->seriove_cislo, '</td>', PHP_EOL;
    echo '<td>', $access->ucebna_ID, '</td>', PHP_EOL;
    $edit_url = site_url() . 'classroom/access/edit/' . $access->prislusenstvo_ID . '/?search=' . $search;
    $delete_url = site_url() . 'classroom/access/delete/' . $access->prislusenstvo_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
