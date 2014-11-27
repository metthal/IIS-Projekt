<?php

class Timetable extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!check_login())
            redirect('login', 'refresh');

        $data = array(
            'title' => 'Rozvrh',
            'subtitle' => 'Rozvrh',
            'menu_items' => $this->menu->load('menu_main', $this->user_model->privileges(login_data('id'))),
            'rooms' => $this->room_model->roomlist(),
            'menu_item_selected' => 'timetable'
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('timetable_view', $data);
        $this->load->view('footer');
    }

    public function get($roomID, $date)
    {
        if (!check_login())
            return;

        $events = $this->room_model->schedules_for($roomID, $date);
        $timetable = array();

        if ($events != false)
        {
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
        }

        $data = array(
            'timetable' => $timetable
        );

        $this->load->view('timetable_get_view', $data);
    }
}
