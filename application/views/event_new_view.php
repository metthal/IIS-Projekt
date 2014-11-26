<?php echo validation_errors(); ?>

<?php echo form_open('event/new/?search=' . $search) ?>
    Názov:<input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>
    Predmet:<select name="subject">
<?php

foreach ($subjects as &$subject)
{
    echo '<option value="', $subject->predmet_ID, '">', $subject->nazov_predmetu, '</option>', PHP_EOL;
}

?>
    </select><br>
    Dátum konania:<input type="text" name="date" value="<?php echo set_value('date'); ?>">
    o <input type="text" name="hour" value="<?php echo set_value('hour'); ?>"><br>
    Trvanie:<input type="text" name="duration" value="<?php echo set_value('duration'); ?>"><br>
    <input type="hidden" name="user" value="<?php echo login_data('id'); ?>">
    <input type="hidden" name="record" value="0">
    Záznam:<input type="checkbox" name="record" value="1"><br>
    <input type="hidden" name="stream" value="0">
    Stream:<input type="checkbox" name="stream" value="1"><br>
    <div id="rooms">
        Koná sa v: <button onclick="newSchedule(); return false;">+ Pridať</button><br>
        <div class="room">
            <select name="rooms[]">
<?php

foreach ($rooms as &$room)
{
    echo '<option value="', $room->ucebna_ID, '">', $room->kridlo, $room->cislo_ucebne, '</option>', PHP_EOL;
}

?>
            </select>
            <button id="0" onclick="delSchedule(0); return false;">X</button>
        </div>
    </div>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'event/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>

<script>
var count = 1;

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
