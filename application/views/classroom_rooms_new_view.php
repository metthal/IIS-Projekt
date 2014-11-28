<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form action="<?php echo site_url(), 'classroom/rooms/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form><br>
<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/new/?search=' . $search) ?>
    <table class="form_table">
    <tr class="form_table_row">
        <td>Krilo:</td>
        <td><input type="text" name="side" value="<?php echo set_value('side'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Číslo učebne:</td>
        <td><input type="text" name="room_no" value="<?php echo set_value('room_no'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Kapacita ucebne:</td>
        <td><input type="text" name="capacity" value="<?php echo set_value('capacity'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td><div id="accesses">
        <td>Prislusenstvo:  <button onclick="newSchedule(); return false;">+ Pridať</button></td>
    <select class="access" name="accesses[]">
<?php
    foreach ($accesses as &$access)
        echo '<option value="', $access->prislusenstvo_ID, '">', $this->typeaccess_model->typeaccess_get_nametype($access->seriove_cislo), ' - ',$access->seriove_cislo, '</option>', PHP_EOL;
?>
    </select></td>
    </div></tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</form>
</table>

</div>
</div>

<script>
function newSchedule()
{
    var access = document.getElementsByClassName("access");
    var new_access = access[0].cloneNode(true);
    document.getElementById("accesses").appendChild(new_access);
    document.getElementById("accesses").appendChild(document.createElement("br"));
}
</script>
