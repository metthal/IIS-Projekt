<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'classroom/access/new/?search=', $search; ?>">Pridať príslušenstvo</a>

<form class="search_form" method="get" action="<?php echo site_url(); ?>classroom/access">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať">
</form>
</div>

<table class="content_table">
<thead>
<th>Názov príslušenstva</th>
<th>Seriové číslo</th>
<th>Používané v</th>
<th>Upraviť</th>
</thead>
<tbody class="content_table_body">
<?php

foreach ($accesss as &$access)
{
    echo '<td>', $this->typeaccess_model->typeaccess_name($access->typ_ID)->nazov_typu, '</td>', PHP_EOL;
    echo '<td>', $access->seriove_cislo, '</td>', PHP_EOL;
    if ($access->ucebna_ID != NULL)
        echo '<td>', $this->room_model->room_get($access->ucebna_ID)->kridlo, $this->room_model->room_get($access->ucebna_ID)->cislo_ucebne, '</td>', PHP_EOL;
    else
    echo '<td>',' ', '</td>', PHP_EOL;
    $edit_url = site_url() . 'classroom/access/edit/' . $access->prislusenstvo_ID . '/?search=' . $search;
    $delete_url = site_url() . 'classroom/access/delete/' . $access->prislusenstvo_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">&#x274C</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>
</div>
</div>
