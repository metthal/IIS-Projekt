<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/edit/' . $room->ucebna_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $room->ucebna_ID; ?>">
Kridlo:<input type="text" name="side" value="<?php echo $room->kridlo; ?>"><br>
Cislo ucebne:<input type="text" name="room_no" value="<?php echo $room->cislo_ucebne; ?>"><br>
Kapacita ucebne:<input type="text" name="capacity" value="<?php echo $room->kapacita; ?>"><br>
<div id="accesses">
Prislusenstvo:  <button onclick="newSchedule(); return false;">+ Pridať</button><br>
    <select class="access" name="accesses[]">
<?php
    foreach ($accesses as &$access)
        echo '<option value="', $access->prislusenstvo_ID, '">', $access->seriove_cislo, '</option>', PHP_EOL;
?>
    </select><br>
    </div>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/rooms/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>

<script>
function newSchedule()
{
    var access = document.getElementsByClassName("access");
    var new_access = access[0].cloneNode(true);
    document.getElementById("accesses").appendChild(new_access);
    document.getElementById("accesses").appendChild(document.createElement("br"));
}
</script>
