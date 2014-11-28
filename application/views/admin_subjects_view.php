<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'admin/subject/new/?search=', $search; ?>">Pridať predmet</a><br>

<form class="search_form" method="get" action="<?php echo site_url(); ?>admin/subject/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>
</div>

<table class="content_table">
<thead>
    <tr>
        <th>Názov</th>
        <th>Kredity</th>
        <th>Ročník</th>
        <th>Garant</th>
        <th>Úpravy</th>
    </tr>
</thead>
<tbody class="content_table_body">
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
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">❌</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>

</div>
</div>
