<table>
<?php

/*for ($hour = 0; $hour < 24; $hour++)
{
    echo '<tr><td>', $hour, ':00</td>';
    for ($col = 0; $col < count($timetable); $col++)
    {
        if ($timetable[$col][$hour] == 1)
            continue;
        else if ($timetable[$col][$hour] == 0)
            echo '<td></td>', PHP_EOL;
        else
            echo '<td bgcolor="#777777" rowspan="', $timetable[$col][$hour][0], '">', $timetable[$col][$hour][1], '</td>', PHP_EOL;
    }
    echo '</tr>';
}*/

echo '<tr>';
for ($hour = 0; $hour < 24; $hour++)
    echo '<td>', $hour, ':00</td>';
echo '</tr>';

for ($row = 0; $row < count($timetable); $row++)
{
    echo '<tr>';
    for ($hour = 0; $hour < 24; $hour++)
    {
        if ($timetable[$row][$hour] == 1)
            continue;
        else if ($timetable[$row][$hour] == 0)
            echo '<td></td>', PHP_EOL;
        else
            echo '<td bgcolor="#777777" colspan="', $timetable[$row][$hour][0], '">', $timetable[$row][$hour][1], '</td>', PHP_EOL;
    }
    echo '</tr>';
}

?>
</table>
