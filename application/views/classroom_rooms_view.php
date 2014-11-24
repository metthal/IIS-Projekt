<?php
    if ($can_create)
        echo '<a href="', site_url(), 'classroom/rooms/new/?search=', $search , '">Pridať učebňu</a><br>';
?>

<table>
<?php

foreach ($rooms as &$room)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $room->kridlo, '</td>', PHP_EOL;
    echo '<td>', $room->cislo_ucebne, '</td>', PHP_EOL;
    $edit_url = site_url() . 'admin/classroom/edit/' . $room->ucebna_ID . '/?search=' . $search;
    $delete_url = site_url() . 'admin/classroom/delete/' . $room->ucebna_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
