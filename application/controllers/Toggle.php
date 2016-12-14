<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Toggle extends Application {
    public function index() {
        $origin = $_SERVER['HTTP_REFERER'];
        $role = $this->session->userdata('userrole');
        if($role == 'user')
            $role = 'administrator';
        else if($role == 'administrator')
            $role = 'guest';
        else if($role == 'guest')
            $role = 'user';
        $this->session->set_userdata('userrole', $role);
        redirect($origin);
    }
}