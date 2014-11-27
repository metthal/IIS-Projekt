<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/edit/' . $room->ucebna_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $room->ucebna_ID; ?>">
Kridlo:<input type="text" name="side" value="<?php echo $room->kridlo; ?>"><br>
Cislo ucebne:<input type="text" name="room_no" value="<?php echo $room->cislo_ucebne; ?>"><br>
Kapacita ucebne:<input type="text" name="capacity" value="<?php echo $room->kapacita; ?>"><br>
<div id="accesses">
Prislusenstvo:  <button onclick="newSchedule(); return false;">+ Pridať</button><br>
<?php

    $counter = 0;
    foreach ($rooms as &$room)
    {
        echo '<div class="access">', PHP_EOL;
        echo '<select name="accesses[]">', PHP_EOL;
        foreach ($accesses as &$access)
        {
            echo '<option value="', $access->prislusenstvo_ID, '"';
            if ($access->ucebna_ID == $room->ucebna_ID)
                echo ' selected="selected"';
            echo '>', $this->typeaccess_model->typeaccess_get_nametype($access->seriove_cislo),' - ', $access->seriove_cislo, '</option>', PHP_EOL;
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
<form style="display: inline;" action="<?php echo site_url(), 'classroom/rooms/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>

<script>
var count = <?php echo count($rooms); ?>;

function newSchedule()
{
    var access = document.getElementsByClassName("access");
    var new_access = access[0].cloneNode(true);
    for (i = 0; i < new_access.childNodes.length; i++)
    {
        if (new_access.childNodes[i].nodeName.toUpperCase() == "BUTTON")
        {
            new_access.childNodes[i].setAttribute("id", count);
            new_access.childNodes[i].setAttribute("onclick", "delSchedule(" + count++ + "); return false;");
            break;
        }
    }
    document.getElementById("accesses").appendChild(new_access);

}

function delSchedule(index)
{
    if (document.getElementsByClassName("access").length == 1)
        return;

    var del_access = document.getElementById(index);
    del_access.parentNode.parentNode.removeChild(del_access.parentNode);
}
</script>
