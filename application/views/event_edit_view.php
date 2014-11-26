<?php echo validation_errors(); ?>

<?php echo form_open('event/edit/' . $event->akcia_ID . '?search=' . $search) ?>
    Názov:<input type="text" name="name" value="<?php echo $event->nazov; ?>"><br>
    Predmet:<select name="subject">
<?php

foreach ($subjects as &$subject)
{
    echo '<option ';
    if ($subject->predmet_ID == $event->predmet_ID)
        echo 'selected="selected"';
    echo 'value="', $subject->predmet_ID, '">', $subject->nazov_predmetu, '</option>', PHP_EOL;
}

?>
    </select><br>
    Dátum konania:<input type="text" name="date" value="<?php echo date('Y-m-d', strtotime($event->datum_konania)); ?>">
    o <input type="text" name="hour" value="<?php echo date('G', strtotime($event->datum_konania)); ?>"><br>
    Trvanie:<input type="text" name="duration" value="<?php echo $event->trvanie; ?>"><br>
    <input type="hidden" name="user" value="<?php echo login_data('id'); ?>">
    <input type="hidden" name="record" value="0">
    Záznam:<input type="checkbox" name="record" value="1" <?php if ($event->zaznam) echo 'checked'; ?>><br>
    <input type="hidden" name="stream" value="0">
    Stream:<input type="checkbox" name="stream" value="1" <?php if ($event->stream) echo 'checked'; ?>><br>
    <div id="rooms">
    Koná sa v: <button onclick="newSchedule(); return false;">+ Pridať</button><br>
<?php

    $counter = 0;
    foreach ($schedules as &$schedule)
    {
        echo '<div class="room">', PHP_EOL;
        echo '<select name="rooms[]">', PHP_EOL;
        foreach ($rooms as &$room)
        {
            echo '<option value="', $room->ucebna_ID, '"';
            if ($room->ucebna_ID == $schedule->ucebna_ID)
                echo ' selected="selected"';
            echo '>', $room->kridlo, $room->cislo_ucebne, '</option>', PHP_EOL;
        }
        echo '</select>';
        echo '<button id="', $counter, '" onclick="delSchedule(', $counter, '); return false;">X</button>', PHP_EOL;
        echo '</div>', PHP_EOL;
        $counter++;
    }
?>
    </div>
    <input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'event/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>

<script>
var count = <?php echo count($schedules); ?>;

function newSchedule()
{
    var room = document.getElementsByClassName("room");
    var new_room = room[0].cloneNode(true);
    for (i = 0; i < new_room.childNodes.length; i++)
    {
        if (new_room.childNodes[i].nodeName.toUpperCase() == "BUTTON")
        {
            new_room.childNodes[i].setAttribute("id", count);
            new_room.childNodes[i].setAttribute("onclick", "delSchedule(" + count++ + "); return false;");
            break;
        }
    }
    document.getElementById("rooms").appendChild(new_room);
}

function delSchedule(index)
{
    if (document.getElementsByClassName("room").length == 1)
        return;

    var del_room = document.getElementById(index);
    del_room.parentNode.parentNode.removeChild(del_room.parentNode);
}
</script>

