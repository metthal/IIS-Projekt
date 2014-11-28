<table class="timetable_table">
<?php

echo '<thead>';
for ($hour = 0; $hour < 24; $hour++)
    echo '<th>', $hour, ':00</th>';
echo '</th>';
echo '</thead><tbody>';

if (count($timetable) == 0)
{
    echo '<tr><td class="no_data" colspan="24">Žiadne akcie sa v tento deň nekonajú</td></tr>';
}
else
{
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
                echo '<td class="reserved" colspan="', $timetable[$row][$hour][0], '"><a href="#"',
                'info="Predmet: ', $timetable[$row][$hour][2], '&#xa;Ročník: ', $timetable[$row][$hour][3],
                '&#xa;Obor: ', $timetable[$row][$hour][4], '&#xa;Garant: ', $timetable[$row][$hour][5],
                '">', $timetable[$row][$hour][1], '</a></td>', PHP_EOL;
        }
        echo '</tr>';
    }
}
echo '</tbody>';

?>
</table>
