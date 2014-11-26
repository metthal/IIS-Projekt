<table>
<?php

$timetable = array(/*0 => array_fill(0, 24, 0)*/);

foreach ($events as &$event)
{
    $start_hour = date('G', strtotime($event->datum_konania));
    $duration = $event->trvanie;

    $cols = count($timetable);
    for ($i = 0; $i < $cols; $i++)
    {
        for ($j = $start_hour; $j < min($start_hour + $duration, 24); $j++)
        {
            if ($timetable[$i][$j] != 0)
                break;
        }

        // there is free place in timetable, insert our event
        if ($j == min($start_hour + $duration, 24))
        {
            $timetable[$i][$start_hour] = array($duration, $event->nazov);
            for ($j = $start_hour + 1; $j < min($start_hour + $duration, 24); $j++)
                $timetable[$i][$j] = 1;

            $j = -1;
            break;
        }
    }

    // there is no free place, create new column
    if ($i == $cols)
        $timetable = $timetable + array($i => array_fill(0, 24, 0));

    $timetable[$i][$start_hour] = array($duration, $event->nazov);
    for ($j = $start_hour + 1; $j < min($start_hour + $duration, 24); $j++)
        $timetable[$i][$j] = 1;
}

for ($hour = 0; $hour < 24; $hour++)
{
    echo '<tr><td>', $hour, ':00 - ', ($hour + 1) % 24, ':00</td>';
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
}

?>
</table>
