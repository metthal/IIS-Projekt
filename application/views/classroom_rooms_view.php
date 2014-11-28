<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<?php
    if ($can_create)
        echo '<a href="', site_url(), 'classroom/rooms/new/?search=', $search , '">Pridať učebňu</a>';
?>
<form class="search_form" method="get" action="<?php echo site_url(); ?>classroom/rooms/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať">
</form>
</div>

<table class="content_table">
<thead>
    <tr>
        <th>Krídlo</th>
        <th>číslo učebne</th>
        <th>Kapacita učebne</th>
        <th>Typ príslušenstva, počet kusov</th>
        <th>Úpravy</th>
    </tr>
</thead>
<tbody class="content_table_body">
<?php

foreach ($rooms as &$room)
{
    $array_access_name = array();
    $array_access_count = array();
    foreach ($accesses as &$access)
    {
        if($access->ucebna_ID == $room->ucebna_ID)
        {
            $access_name = $this->typeaccess_model->typeaccess_name($access->typ_ID);
            if (!in_array($access_name->nazov_typu,$array_access_name))
            {
                $item_to_push = $access_name->nazov_typu . " (" . $this->typeaccess_model->typeaccess_get_type_count($access_name->nazov_typu) . " ks),";
                array_push($array_access_name,$item_to_push);
            }
        }
    }

    $array = implode(", ", $array_access_name);

    echo '<tr>', PHP_EOL;
    echo '<td>', $room->kridlo, '</td>', PHP_EOL;
    echo '<td>', $room->cislo_ucebne, '</td>', PHP_EOL;
    echo '<td>', $room->kapacita, '</td>', PHP_EOL;
    echo '<td>', $array, '</td>', PHP_EOL;
    $edit_url = site_url() . 'classroom/rooms/edit/' . $room->ucebna_ID . '/?search=' . $search;
    $delete_url = site_url() . 'classroom/rooms/delete/' . $room->ucebna_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">&#x274C</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>
</div>
</div>
