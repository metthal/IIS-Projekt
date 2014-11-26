Učebňa:
<select id="rooms" onchange="getTimetable()">
<?php
foreach ($rooms as &$room)
{
    echo '<option value="', $room->ucebna_ID, '">', $room->kridlo, $room->cislo_ucebne, '</option>', PHP_EOL;
}

?>
</select><br>

<div id="timetable">
</div>

<script>
currentRoomID = <?php if (count($rooms) > 0) echo $rooms[0]->ucebna_ID; else echo '0'; ?>;

function createXmlHttpRequestObject()
{
    var xmlHttp;
    try
    {
        xmlHttp = new XMLHttpRequest(); //should work on all browsers except IE6 or older
    }
    catch (e)
    {
        try
        {
          xmlHttp = new ActiveXObject("Microsoft.XMLHttp"); //browser is IE6 or older
        }
        catch (e)
        {
          // ignore error
        }
    }

    if (!xmlHttp)
        alert ("Error creating the XMLHttpRequest object.");
    else
        return xmlHttp;
}

function getTimetable()
{
    var roomSelect = document.getElementById("rooms");
    var xmlHttp = createXmlHttpRequestObject();
    xmlHttp.open("GET", "<?php echo site_url(); ?>timetable/get/" + roomSelect.options[roomSelect.selectedIndex].value, true);
    xmlHttp.onreadystatechange = function()
    {
        if ((xmlHttp.readyState==4) && (xmlHttp.status==200))
            document.getElementById("timetable").innerHTML = xmlHttp.responseText;
    }
    xmlHttp.send();
}

getTimetable();

</script>
