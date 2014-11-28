<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<a href="<?php echo site_url(), 'event/new/?search=', $search; ?>">Pridať akciu</a><br>

<form class="search_form" method="get" action="<?php echo site_url(); ?>event/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table class="content_table">
<thead>
    <th>Názov</th>
    <th>Dátum konania</th>
    <th>Od</th>
    <th>Do</th>
    <th>Predmet</th>
    <th>Záznam</th>
    <th>Stream</th>
    <th>Rezervoval</th>
    <th>Rezervované</th>
    <th>Úpravy</th>
</thead>
<tbody class="content_table_body">
<?php

foreach ($events as &$event)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $event->nazov, '</td>', PHP_EOL;
    echo '<td>', date('Y-m-d', strtotime($event->datum_konania)), '</td>', PHP_EOL;
    echo '<td>', date('G:i', strtotime($event->datum_konania)), '</td>', PHP_EOL;
    echo '<td>', date('G:i', strtotime($event->datum_konania . '+' . $event->trvanie . ' hours')), '</td>', PHP_EOL;
    echo '<td>', $event->predmet, '</td>', PHP_EOL;
    echo '<td style="text-align: center"><input type="checkbox" onclick="return false" ';
    if ($event->zaznam)
        echo 'checked';
    echo '></td>', PHP_EOL;
    echo '<td style="text-align: center"><input type="checkbox" onclick="return false" ';
    if ($event->stream)
        echo 'checked';
    echo '></td>', PHP_EOL;
    echo '<td>', $event->uzivatel, '</td>', PHP_EOL;
    echo '<td>', $event->datum_rezervacie, '</td>', PHP_EOL;
    echo '</td>', PHP_EOL;
    $edit_url = site_url() . 'event/edit/' . $event->akcia_ID . '/?search=' . $search;
    $delete_url = site_url() . 'event/delete/' . $event->akcia_ID . '/?search=' . $search;
    echo '<td class="last_field"><a href="', $edit_url, '">✎</a> <a href="', $delete_url, '">❌</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</tbody>
</table>

</div>
</div>
