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
        <td>Krídlo:</td>
        <td><input type="text" name="side" value="<?php echo set_value('side'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Číslo učebne:</td>
        <td><input type="text" name="room_no" value="<?php echo set_value('room_no'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Kapacita učebne:</td>
        <td><input type="text" name="capacity" value="<?php echo set_value('capacity'); ?>"></td>
    </tr>
    <tr class="form_table_row">
        <td>Príslušenstvo:</td>
        <td><button onclick="newSchedule(); return false;">+ Pridať</button></td>
    </tr>
    <tr class="form_table_row">
        <td colspan="2" style="text-align: center">
            <div id="accesses">
                <div class="access">
                 <select name="accesses[]">
                    <?php
                    foreach ($accesses as &$access)
                        echo '<option value="', $access->prislusenstvo_ID, '">',
                            $this->typeaccess_model->typeaccess_get_nametype($access->seriove_cislo), ' - ',$access->seriove_cislo, '</option>', PHP_EOL;
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

<script type="text/javascript">
var count = 1;

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
