<div class="content">
<div class="content_wrapper">
<h1><?php echo $subtitle; ?></h1>
<form style="display: inline;" action="<?php echo site_url(), 'classroom/rooms'; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="submit" value="< Späť">
</form>
<?php echo validation_errors(); ?>


<?php echo form_open('classroom/rooms/edit/' . $room->ucebna_ID . '/?search=' . $search) ?>
    <input type="hidden" name="id" value="<?php echo $room->ucebna_ID; ?>">
<table class="form_table">
    <tr class="form_table_row">
        <td class="required">Krídlo:</td>
        <td><input type="text" name="side" value="<?php echo $room->kridlo; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Číslo učebne:</td>
        <td><input type="text" name="room_no" value="<?php echo $room->cislo_ucebne; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td class="required">Kapacita učebne:</td>
        <td><input type="text" name="capacity" value="<?php echo $room->kapacita; ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Príslušenstvo:</td>
        <td><button onclick="newSchedule(); return false;">+ Pridať</button></td>
    </tr>
    <tr class="form_table_row">
        <td colspan="2" style="text-align: center">
            <div id="accesses">
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
                        echo '</select>', PHP_EOL;
                        echo '<button id="button', $counter, '" onclick="delSchedule(', $counter, '); return false;">❌</button>', PHP_EOL;
                        echo '</div>', PHP_EOL;
                        $counter++;
                    }
                ?>
            </div>
        </td>
    </tr>
    <tr><td colspan="2"><input type="submit" name="edit_request" value="Uložiť"></td></tr>
</table>
</form>
<div class="req_hint">
    <span class="hint">Povinné položky sú označené hrubým písmom</span>
</div>

<script type="text/javascript">
var count = <?php echo count($rooms); ?>;

function newSchedule()
{
    var access = document.getElementsByClassName("access");
    var new_access = access[0].cloneNode(true);
    for (i = 0; i < new_access.childNodes.length; i++)
    {
        if (new_access.childNodes[i].nodeName.toUpperCase() == "BUTTON")
        {
            new_access.childNodes[i].setAttribute("id", "button" + count);
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

    var del_access = document.getElementById("button" + index);
    del_access.parentNode.parentNode.removeChild(del_access.parentNode);
}
</script>

</div>
</div>
