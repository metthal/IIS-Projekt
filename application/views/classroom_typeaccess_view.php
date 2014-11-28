<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'classroom/typeaccess/new/?search=', $search; ?>">Pridať typ príslušenstva</a>

<form class="search_form" method="get" action="<?php echo site_url(); ?>classroom/typeaccess">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať">
</form>
</div>

<table class="content_table">
<thead>
    <tr>
        <th>Názov typu príslušenstva</th>
        <th>Upraviť</th>
    </tr>
</thead>
<tbody class="content_table_body">
<?php

foreach ($typeaccesses as &$typeaccess)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $typeaccess->nazov_typu, '</td>', PHP_EOL;
    $edit_url = site_url() . 'classroom/typeaccess/edit/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search;
    $delete_url = site_url() . 'classroom/typeaccess/delete/' . $typeaccess->typ_prislusenstva_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">&#x274C</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>
</div>
</div>
