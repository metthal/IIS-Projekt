<?php echo validation_errors(); ?>

<?php echo form_open('classroom/rooms/new/?search=' . $search) ?>
    Kridlo:<input type="text" name="side" value="<?php echo set_value('side'); ?>"><br>
    Cislo ucebne:<input type="text" name="room_no" value="<?php echo set_value('room_no'); ?>"><br>
    <input type="submit" name="new_request" value="Uložiť">
</form>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/rooms/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="Späť">
</form><br>
