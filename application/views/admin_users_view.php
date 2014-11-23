<form method="get" action="<?php echo site_url(); ?>admin/users/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($users as &$user)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $user->login, '</td>', PHP_EOL;
    echo '<td>', $user->meno, ' ', $user->priezvisko, '</td>', PHP_EOL;
    echo '<td>', $user->mail, '</td>', PHP_EOL;
    echo '<td>', $user->tel_cislo, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/users/edit/' . $user->uzivatel_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/users/delete/' . $user->uzivatel_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
