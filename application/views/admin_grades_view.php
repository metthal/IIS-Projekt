<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'admin/grade/new/?search=', $search; ?>">Pridať ročník</a><br>

<form class="search_form" method="get" action="<?php echo site_url(); ?>admin/grade/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>
</div>

<table class="content_table">
<thead>
    <tr>
        <th>Názov</th>
        <th>Začiatok štúdia</th>
        <th>Obor</th>
        <th>Úpravy</th>
    </tr>
</thead>
<tbody class="content_table_body">
<?php

foreach ($grades as &$grade)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $grade->nazov, '</td>', PHP_EOL;
    echo '<td>', $grade->zaciatok_stud, '</td>', PHP_EOL;
    echo '<td>', $grade->obor, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/grade/edit/' . $grade->rocnik_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/grade/delete/' . $grade->rocnik_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">❌</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>

</div>
</div>
