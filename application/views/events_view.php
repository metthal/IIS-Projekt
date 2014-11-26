<a href="<?php echo site_url(), 'event/new/?search=', $search; ?>">Pridať akciu</a><br>

<form method="get" action="<?php echo site_url(); ?>event/">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Hľadať"><br>
</form>

<table>
<?php

foreach ($events as &$event)
{
    echo '<tr>', PHP_EOL;
    echo '<td>', $event->nazov, '</td>', PHP_EOL;
    echo '<td>', $event->datum_konania, '</td>', PHP_EOL;
    echo '<td>', $event->trvanie, '</td>', PHP_EOL;
    echo '<td>', $event->predmet, '</td>', PHP_EOL;
    echo '<td><input type="checkbox" onclick="return false" ';
    if ($event->zaznam)
        echo 'checked';
    echo '></td>', PHP_EOL;
    echo '<td><input type="checkbox" onclick="return false" ';
    if ($event->stream)
        echo 'checked';
    echo '></td>', PHP_EOL;
    echo '<td>', $event->uzivatel, '</td>', PHP_EOL;
    echo '<td>', $event->datum_rezervacie, '</td>', PHP_EOL;
    echo '</td>', PHP_EOL;
    $edit_url = site_url() . 'event/edit/' . $event->akcia_ID . '/?search=' . $search;
    $delete_url = site_url() . 'event/delete/' . $event->akcia_ID . '/?search=' . $search;
    echo '<td><a href="', $edit_url, '">E</a> <a href="', $delete_url, '">X</a></td>', PHP_EOL;
    echo '</tr>', PHP_EOL;
}

?>
</table>
