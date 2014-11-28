<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'admin/dep/new/?search=', $search; ?>">Pridať obor</a><br>

<form class="search_form" method="get" action="<?php echo site_url(); ?>admin/dep/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať">
</form>
</div>

<table class="content_table">
<thead>
    <tr>
        <th>Názov</th>
        <th>Titul</th>
        <th>Úpravy</th>
    </tr>
</thead>
<tbody class="content_table_body">
<?php

foreach ($deps as &$dep)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $dep->nazov, '</td>', PHP_EOL;
    echo '<td>', $dep->titul, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/dep/edit/' . $dep->obor_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/dep/delete/' . $dep->obor_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">❌</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>
</div>
</div>
