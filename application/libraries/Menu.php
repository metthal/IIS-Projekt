<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuItem
{
    public $name;
    public $link;

    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }
}

class Menu
{
    protected $menus;

    public function __construct()
    {
        $this->menus['menu_main'] = array(
            // Student privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'timetable'),
                new MenuItem('Profil', 'profil'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Professor privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'timetable'),
                new MenuItem('Učebne', 'classroom'),
                new MenuItem('Akcie', 'event'),
                new MenuItem('Profil', 'profil'),
                new MenuItem('Administrácia', 'admin'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Admin privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'timetable'),
                new MenuItem('Učebne', 'classroom'),
                new MenuItem('Akcie', 'event'),
                new MenuItem('Profil', 'profil'),
                new MenuItem('Administrácia', 'admin'),
                new MenuItem('Odhlásiť', 'logout')
            )
        );

        $this->menus['menu_admin'] = array(
            // Student privileges
            array(),
            // Professor privileges
            array(
                new MenuItem('Obory', 'admin/dep'),
                new MenuItem('Predmety', 'admin/subject'),
                new MenuItem('Ročníky', 'admin/class')
            ),
            // Admin privileges
            array(
                new MenuItem('Obory', 'admin/dep'),
                new MenuItem('Predmety', 'admin/subject'),
                new MenuItem('Ročníky', 'admin/grade'),
                new MenuItem('Užívatelia', 'admin/users'),
                new MenuItem('Obnova', 'admin/reset'),
            )
        );

        $this->menus['menu_profil'] = array(
            // Student privileges
            array(
                new MenuItem('Zmena hesla', 'profil/change_passwd'),
                new MenuItem('Zmena e-mailu', 'profil/change_email'),
            ),
            // Professor privileges
            array(
                new MenuItem('Zmena hesla', 'profil/change_passwd'),
                new MenuItem('Zmena e-mailu', 'profil/change_email'),
            ),
            // Admin privileges
            array(
                new MenuItem('Zmena hesla', 'profil/change_passwd'),
                new MenuItem('Zmena e-mailu', 'profil/change_email'),
            )
        );

        $this->menus['menu_classroom'] = array(
            // Student privileges
            array(),
            // Professor privileges
            array(
                new MenuItem('Učebne', 'classroom/rooms'),
            ),
            // Admin privileges
            array(
                new MenuItem('Učebne', 'classroom/rooms'),
                new MenuItem('Príslušenstvá', 'classroom/access/'),
                new MenuItem('Typ Príslušenstva', 'classroom/typeaccess')
            )
        );
    }

    public function load($menu_name, $privileges)
    {
        if ($privileges > 2)
            return false;

        if (!array_key_exists($menu_name, $this->menus))
            return false;

        return $this->menus[$menu_name][$privileges];
    }
}

?>
