<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'admin/users/new/?search=', $search; ?>">Pridať užívateľa</a>

<form class="search_form" method="get" action="<?php echo site_url(); ?>admin/users/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať">
</form>
</div>

<table class="content_table">
<thead>
<th>Login</th>
<th>Meno</th>
<th>E-mail</th>
<th>Tel. číslo</th>
<th>Úpravy</th>
</thead>
<tbody class="content_table_body">
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
    echo '<td class="last_field"><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>
</div>
</div>
