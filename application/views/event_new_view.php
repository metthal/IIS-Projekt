<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>

<form style="display: inline;" action="<?php echo site_url(), 'event/'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>

<?php echo validation_errors(); ?>

<?php echo form_open('event/new/?search=' . $search) ?>
<input type="hidden" name="user" value="<?php echo login_data('id'); ?>">
<input type="hidden" name="record" value="0">
<input type="hidden" name="stream" value="0">
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Názov:</td>
        <td><input type="text" name="name" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Predmet:</td>
        <td>
            <select name="subject">
                <?php

                foreach ($subjects as &$subject)
                {
                    echo '<option value="', $subject->predmet_ID, '">', $subject->nazov_predmetu, '</option>', PHP_EOL;
                }

                ?>
            </select>
        </td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Dátum konania:</td>
        <td><input type="text" name="date" value="<?php echo set_value('date'); ?>">
            od <input style="width: 30px" type="text" name="hour" value="<?php echo set_value('hour'); ?>"> hod.
            <span class="hint">(YYYY-mm-dd)</span></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Trvanie:</td>
        <td><input style="width: 30px" type="text" name="duration" value="<?php echo set_value('duration'); ?>"> hod.</td>
    </tr>
    <tr class="form_table_row">
        <td>Záznam:</td>
        <td><input type="checkbox" name="record" value="1"></td>
    </tr>
    <tr class="form_table_row">
        <td>Stream:</td>
        <td><input type="checkbox" name="stream" value="1"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Koná sa v:</td>
        <td><button onclick="newSchedule(); return false;">+ Pridať</button></td>
    </tr>
    <tr class="form_table_row">
        <td colspan="2" style="text-align: center">
            <div id="rooms">
                <div class="room">
                    <select name="rooms[]">
                        <?php

                        foreach ($rooms as &$room)
                        {
                            echo '<option value="', $room->ucebna_ID, '">', $room->kridlo, $room->cislo_ucebne, '</option>', PHP_EOL;
                        }

                        ?>
                    </select>
                    <button id="button0" onclick="delSchedule(0); return false;">❌</button>
                </div>
            </div>
        </td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="new_request" value="Uložiť"></td></tr>
</table>
</form>
<div class="req_hint">
    <span class="hint">Povinné položky sú označené hrubým písmom</span>
</div>

<script type="text/javascript">
var count = 1;

function newSchedule()
{
    var room = document.getElementsByClassName("room");
    var new_room = room[0].cloneNode(true);
    for (i = 0; i < new_room.childNodes.length; i++)
    {
        if (new_room.childNodes[i].nodeName.toUpperCase() == "BUTTON")
        {
            new_room.childNodes[i].setAttribute("id", "button" + count);
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

    var del_room = document.getElementById("button" + index);
    del_room.parentNode.parentNode.removeChild(del_room.parentNode);
}
</script>

</div>
</div>
