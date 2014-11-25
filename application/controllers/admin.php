<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'users', $subaction = '')
    {
        if (!check_login())
            redirect('login', 'refresh');

        // only users with privileges 2 have access to this site
        $privileges = $this->user_model->privileges(login_data('id'));
        if ($privileges == 0)
            redirect('home', 'refresh');

        if ($privileges == 1 && $action == 'users')
            $action = 'dep';

        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_admin', $privileges);

        $data = array(
            'title' => 'Administrácia',
            'menu_items' => $menu_items,
            'submenu_items' => $submenu_items
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('submenu', $data);

        if ($action == 'users')
        {
            if ($privileges != 2)
                redirect('home', 'refresh');

            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->user_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->user_delete($args[2]);
                else if ($subaction == 'new')
                    $this->user_new();
                else
                    $this->users();
            }
            else if ($subaction == 'new')
                $this->user_new();
            else
                $this->users();
        }
        else if ($action == 'reset')
        {
            if ($privileges != 2)
                redirect('home', 'refresh');

            $this->reset();
        }
        else if ($action == 'dep')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->dep_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->dep_delete($args[2]);
                else if ($subaction == 'new')
                    $this->dep_new();
                else
                    $this->deps();
            }
            else if ($subaction == 'new')
                $this->dep_new();
            else
                $this->deps();
        }
        else if ($action == 'grade')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->grade_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->grade_delete($args[2]);
                else if ($subaction == 'new')
                    $this->grade_new();
                else
                    $this->grades();
            }
            else if ($subaction == 'new')
                $this->grade_new();
            else
                $this->grades();
        }
        else if ($action == 'subject')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->subject_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->subject_delete($args[2]);
                else if ($subaction == 'new')
                    $this->subject_new();
                else
                    $this->subjects();
            }
            else if ($subaction == 'new')
                $this->subject_new();
            else
                $this->subjects();
        }

        $this->load->view('footer');
    }

    public function users()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $users = $this->user_model->userlist();
        else
        {
            $this->form_validation->run();
            $users = $this->user_model->userlist($search);
        }

        $data = array(
            'search' => $search,
            'users' => $users
        );
        $this->load->view('admin_users_view', $data);
    }

    public function user_edit($userID)
    {
        $search = $this->input->get('search');
        $user = $this->user_model->get($userID);
        if ($user == false)
            redirect('admin/users/?search=' . $search, 'refresh');

        $data = array(
            'search' => $search,
            'user' => $user
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('login', 'Login', 'trim');
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('surname', 'Surname', 'trim');
            $this->form_validation->set_rules('mail', 'Mail', 'trim');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|callback_check_edit_user');

            if ($this->form_validation->run() != false)
            {
                $user = $this->input->post(NULL);
                $this->user_model->edit($userID, $user);
                redirect('admin/users/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_user_edit_view', $data);
    }

    public function check_edit_user($dummy)
    {
        $edit_data = $this->input->post(NULL);

        if ($edit_data['login'] == '')
        {
            $this->form_validation->set_message('check_edit_user', 'Prihlasovacie meno nemôže byť prázdne');
            return false;
        }

        if (!$this->user_model->check_login($edit_data['id'], $edit_data['login']))
        {
            $this->form_validation->set_message('check_edit_user', 'Zadané prihlasovacie meno už je obsadené');
            return false;
        }

        if ($edit_data['name'] == '')
        {
            $this->form_validation->set_message('check_edit_user', 'Meno nemôže byť prázdne');
            return false;
        }

        if ($edit_data['surname'] == '')
        {
            $this->form_validation->set_message('check_edit_user', 'Priezvisko nemôže byť prázdne');
            return false;
        }

        if ($edit_data['mail'] == '')
        {
            $this->form_validation->set_message('check_edit_user', 'E-mail nemôže byť prázdny');
            return false;
        }

        $this->load->helper('email');
        if (!valid_email($edit_data['mail']))
        {
            $this->form_validation->set_message('check_edit_user', 'Zadaný e-mail nie je v platnom formáte');
            return false;
        }

        if (!$this->user_model->check_mail($edit_data['id'], $edit_data['mail']))
        {
            $this->form_validation->set_message('check_edit_user', 'Zadaný e-mail už je obsadený');
            return false;
        }

        return true;
    }

    public function user_delete($userID)
    {
        $this->user_model->delete($userID);
        redirect('admin/users/?search=' . $this->input->get('search'), 'refresh');
    }

    public function user_new()
    {
        $data = array(
            'search' => $this->input->get('search')
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('login', 'Login', 'trim');
            $this->form_validation->set_rules('mail', 'Mail', 'trim');
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('surname', 'Surname', 'trim');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|callback_check_new_user');

            if ($this->form_validation->run() != false)
            {
                $this->user_model->add($this->input->post(NULL));
                redirect('admin/users/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_user_new_view', $data);
    }

    public function check_new_user($dummy)
    {
        $new_data = $this->input->post(NULL);

        if ($new_data['login'] == '')
        {
            $this->form_validation->set_message('check_new_user', 'Prihlasovacie meno nemôže byť prázdne');
            return false;
        }

        if (!$this->user_model->check_login(0, $new_data['login']))
        {
            $this->form_validation->set_message('check_new_user', 'Zadané prihlasovacie meno už je obsadené');
            return false;
        }

        if ($new_data['password'] == '')
        {
            $this->form_validation->set_message('check_new_user', 'Heslo nemôže byť prázdne');
            return false;
        }

        if ($new_data['mail'] == '')
        {
            $this->form_validation->set_message('check_new_user', 'E-mail nemôže byť prázdny');
            return false;
        }

        $this->load->helper('email');
        if (!valid_email($new_data['mail']))
        {
            $this->form_validation->set_message('check_new_user', 'Zadaný e-mail nie je v platnom formáte');
            return false;
        }

        if (!$this->user_model->check_mail(0, $new_data['mail']))
        {
            $this->form_validation->set_message('check_new_user', 'Zadaný e-mail už je obsadený');
            return false;
        }

        return true;
    }

    public function reset()
    {
        if ($this->input->post('reset_request'))
        {
            $this->form_validation->set_rules('reset_request', 'ResetRequest','integer');
            $this->form_validation->run();

            if ($this->input->post('reset_users'))
            {
                $this->user_model->reset();
            }
            if ($this->input->post('reset_actions'))
                $this->action_model->reset();

            if ($this->input->post('reset_rooms'))
            {
                $this->room_model->reset();
                $this->form_validation->set_message('reset_request', 'Reset!');
            }

            if ($this->input->post('reset_db'))
            {
                $this->action_model->reset();
                $this->class_model->reset();
                $this->dep_model->reset();
                $this->grade_model->reset();
                $this->room_model->reset();
                $this->user_model->reset();
            }
        }

        $this->load->view('admin_reset_view');
    }

    public function deps()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $deps = $this->dep_model->deplist();
        else
        {
            $this->form_validation->run();
            $deps = $this->dep_model->deplist($search);
        }

        $data = array(
            'search' => $search,
            'deps' => $deps
        );

        $this->load->view('admin_deps_view', $data);
    }

    public function dep_new()
    {
        $data = array(
            'search' => $this->input->get('search')
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('title', 'Title', 'trim|callback_check_new_dep');

            if ($this->form_validation->run() != false)
            {
                $this->dep_model->add($this->input->post(NULL));
                redirect('admin/dep/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_dep_new_view', $data);
    }

    public function dep_edit($depID)
    {
        $search = $this->input->get('search');
        $dep = $this->dep_model->get($depID);
        if ($dep == false)
            redirect('admin/dep/?search=' . $search, 'refresh');

        $data = array(
            'search' => $search,
            'dep' => $dep
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('title', 'Title', 'trim|callback_check_new_dep');

            if ($this->form_validation->run() != false)
            {
                $dep = $this->input->post(NULL);
                $this->dep_model->edit($depID, $dep);
                redirect('admin/dep/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_dep_edit_view', $data);
    }

    public function dep_delete($depID)
    {
        $this->dep_model->delete($depID);
        redirect('admin/dep/?search=' . $this->input->get('search'), 'refresh');
    }


    public function check_new_dep($dummy)
    {
        $new_data = $this->input->post(NULL);

        if ($new_data['name'] == '')
        {
            $this->form_validation->set_message('check_new_dep', 'Názov nemôže byť prázdny');
            return false;
        }

        if ($new_data['title'] == '')
        {
            $this->form_validation->set_message('check_new_dep', 'Titul nemôže byť prázdny');
            return false;
        }

        return true;
    }

    public function grades()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $grades = $this->grade_model->gradelist();
        else
        {
            $this->form_validation->run();
            $grades = $this->grade_model->gradelist($search);
        }

        $data = array(
            'search' => $search,
            'grades' => $grades,
            'deps' => $this->dep_model->deplist()
        );

        $this->load->view('admin_grades_view', $data);
    }

    public function grade_new()
    {
        $data = array(
            'search' => $this->input->get('search'),
            'deps' => $this->dep_model->deplist()
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('start_date', 'Start date', 'trim|callback_check_new_grade');

            if ($this->form_validation->run() != false)
            {
                $this->grade_model->add($this->input->post(NULL));
                redirect('admin/grade/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_grade_new_view', $data);
    }

    public function grade_edit($gradeID)
    {
        $search = $this->input->get('search');
        $grade = $this->grade_model->get($gradeID);
        if ($grade == false)
            redirect('admin/grade/?search=' . $search, 'refresh');

        $data = array(
            'search' => $search,
            'grade' => $grade,
            'deps' => $this->dep_model->deplist()
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('', 'Title', 'trim|callback_check_new_grade');

            if ($this->form_validation->run() != false)
            {
                $grade = $this->input->post(NULL);
                $this->grade_model->edit($gradeID, $grade);
                redirect('admin/grade/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_grade_edit_view', $data);
    }

    public function grade_delete($gradeID)
    {
        $this->grade_model->delete($gradeID);
        redirect('admin/grade/?search=' . $this->input->get('search'), 'refresh');
    }


    public function check_new_grade($dummy)
    {
        $new_data = $this->input->post(NULL);

        if ($new_data['name'] == '')
        {
            $this->form_validation->set_message('check_new_grade', 'Názov nemôže byť prázdny');
            return false;
        }

        if ($new_data['start_date'] == '')
        {
            $this->form_validation->set_message('check_new_grade', 'Začiatok štúdia nemôže byť prázdny');
            return false;
        }

        if ($new_data['dep'] == '')
        {
            $this->form_validation->set_message('check_new_grade', 'Musíte zvoliť obor pre ročník');
            return false;
        }

        return true;
    }

    public function subjects()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $subjects = $this->subject_model->subjectlist();
        else
        {
            $this->form_validation->run();
            $subjects = $this->subject_model->subjectlist($search);
        }

        $data = array(
            'search' => $search,
            'subjects' => $subjects,
            'grades' => $this->grade_model->gradelist(),
            'users' => $this->user_model->userlist()
        );

        $this->load->view('admin_subjects_view', $data);
    }

    public function subject_new()
    {
        $data = array(
            'search' => $this->input->get('search'),
            'grades' => $this->grade_model->gradelist(),
            'users' => $this->user_model->userlist()
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('garant', 'Garant', 'trim');
            $this->form_validation->set_rules('grade', 'Grade', 'trim');
            $this->form_validation->set_rules('credits', 'Credits', 'trim|callback_check_new_subject');

            if ($this->form_validation->run() != false)
            {
                $this->subject_model->add($this->input->post(NULL));
                redirect('admin/subject/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_subject_new_view', $data);
    }

    public function subject_edit($subjectID)
    {
        $search = $this->input->get('search');
        $subject = $this->subject_model->get($subjectID);
        if ($subject == false)
            redirect('admin/subject/?search=' . $search, 'refresh');

        $data = array(
            'search' => $search,
            'subject' => $subject,
            'grades' => $this->grade_model->gradelist(),
            'users' => $this->user_model->userlist()
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('garant', 'Garant', 'trim');
            $this->form_validation->set_rules('grade', 'Grade', 'trim');
            $this->form_validation->set_rules('credits', 'Credits', 'trim|callback_check_new_subject');

            if ($this->form_validation->run() != false)
            {
                $subject = $this->input->post(NULL);
                $this->subject_model->edit($subjectID, $subject);
                redirect('admin/subject/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_subject_edit_view', $data);
    }

    public function subject_delete($subjectID)
    {
        $this->subject_model->delete($subjectID);
        redirect('admin/subject/?search=' . $this->input->get('search'), 'refresh');
    }


    public function check_new_subject($dummy)
    {
        $new_data = $this->input->post(NULL);

        if ($new_data['name'] == '')
        {
            $this->form_validation->set_message('check_new_subject', 'Názov nemôže byť prázdny');
            return false;
        }

        if ($new_data['credits'] == '')
        {
            $this->form_validation->set_message('check_new_subject', 'Kredity nemôžu byť prázdne');
            return false;
        }

        if ($new_data['garant'] == '')
        {
            $this->form_validation->set_message('check_new_subject', 'Musíte zvoliť garanta pre predmet');
            return false;
        }

        if ($new_data['grade'] == '')
        {
            $this->form_validation->set_message('check_new_subject', 'Musíte zvoliť ročník pre predmet');
            return false;
        }

        return true;
    }
}

?>
