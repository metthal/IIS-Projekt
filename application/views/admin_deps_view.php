<a href="<?php echo site_url(), 'admin/dep/new/?search=', $search; ?>">Pridať obor</a><br>

<form method="get" action="<?php echo site_url(); ?>admin/dep/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($deps as &$dep)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $dep->nazov, '</td>', PHP_EOL;
    echo '<td>', $dep->titul, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/dep/edit/' . $dep->obor_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/dep/delete/' . $dep->obor_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
