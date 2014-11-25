<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/edit/' . $room->ucebna_ID . '/?search=' . $search) ?>
<input type="hidden" name="id" value="<?php echo $room->ucebna_ID; ?>">
Kridlo:<input type="text" name="side" value="<?php echo $room->kridlo; ?>"><br>
Cislo ucebne:<input type="text" name="room_no" value="<?php echo $room->cislo_ucebne; ?>"><br>
<input type="submit" name="edit_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/rooms/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
