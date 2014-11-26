<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/new/?search=' . $search) ?>
    Kridlo:<input type="text" name="side" value="<?php echo set_value('side'); ?>"><br>
    Cislo ucebne:<input type="text" name="room_no" value="<?php echo set_value('room_no'); ?>"><br>
    Kapacita ucebne:<input type="text" name="capacity" value="<?php echo set_value('capacity'); ?>"><br>
    <div id="accesses">
    Prislusenstvo:  <button onclick="newSchedule(); return false;">+ Pridať</button><br>
    <select class="access" name="accesses[]">
<?php
    foreach ($accesses as &$access)
        echo '<option value="', $access->prislusenstvo_ID, '">', $this->typeaccess_model->typeaccess_get_nametype($access->seriove_cislo), ' - ',$access->seriove_cislo, '</option>', PHP_EOL;
?>
    </select><br>
    </div>
    <input type="submit" name="new_request" value="Uložiť">
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
