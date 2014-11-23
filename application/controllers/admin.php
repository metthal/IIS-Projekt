<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'users')
    {
        if (!check_login())
            redirect('login', 'refresh');

        // only users with privileges 2 have access to this site
        $privileges = $this->user_model->privileges(login_data('id'));
        if ($privileges != 2)
            redirect('home', 'refresh');

        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_admin', $privileges);

        $data = array(
            'title' => 'Administrácia',
            'menu_items' => $menu_items,
            'submenu_items' => $submenu_items
        );

        if ($action == 'users')
            $this->users();
        else if ($action == 'reset')
            $this->reset();

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('admin_view', $data);
        $this->load->view('footer');
    }

    public function users()
    {
    }

    public function reset()
    {
    }
}

?>
