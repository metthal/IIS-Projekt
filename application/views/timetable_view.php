<div class="content">
<div class="content_wrapper">
<div class="content_header">
<h1><?php echo $subtitle; ?></h1>
<?php

$today = date('Y-m-d');
echo '<div style="text-align: center">', PHP_EOL;
echo '<button onclick="prevDay()">&larr;</button>', PHP_EOL;
echo '<span id="currentDate">', $today, '</span>', PHP_EOL;
echo '<button onclick="nextDay()">&rarr;</button><br>', PHP_EOL;
echo '</div>', PHP_EOL;
?>
<div class="search_form">
    Učebňa:
    <select id="rooms" onchange="getTimetable()">
<?php
foreach ($rooms as &$room)
{
    echo '<option value="', $room->ucebna_ID, '">', $room->kridlo, $room->cislo_ucebne, '</option>', PHP_EOL;
}

?>
</select>
</div>
</div>

<div id="timetable">
</div>

<script>
var currentDate = new Date();

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

function dateFormat(dateObj)
{
    var dateStr = dateObj.getFullYear() + "-";
    if (dateObj.getMonth() + 1 < 10)
        dateStr += "0";
    dateStr += (dateObj.getMonth() + 1) + "-";
    if (dateObj.getDate() < 10)
        dateStr += "0";
    dateStr += dateObj.getDate();
    return dateStr;
}

function prevDay()
{
    currentDate.setDate(currentDate.getDate() - 1);
    document.getElementById("currentDate").innerHTML = dateFormat(currentDate);
    getTimetable();
}

function nextDay()
{
    currentDate.setDate(currentDate.getDate() + 1);
    document.getElementById("currentDate").innerHTML = dateFormat(currentDate);
    getTimetable();
}

function getTimetable()
{
    var roomSelect = document.getElementById("rooms");
    var xmlHttp = createXmlHttpRequestObject();
    xmlHttp.open("GET", "<?php echo site_url(); ?>timetable/get/" + roomSelect.options[roomSelect.selectedIndex].value + "/" + dateFormat(currentDate), true);
    xmlHttp.onreadystatechange = function()
    {
        if ((xmlHttp.readyState==4) && (xmlHttp.status==200))
            document.getElementById("timetable").innerHTML = xmlHttp.responseText;
    }
    xmlHttp.send();
}

getTimetable();

</script>

</div>
</div>
