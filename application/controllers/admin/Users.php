<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends AdminController {

public function __construct() {
    parent::__construct();
    $this->load->model('users_model');
}

public function index() {
    $data['users'] = $this->users_model->get_users();
    $this->load->view('admin/users/index', $data);
}

public function create() {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Create a new user';

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() === FALSE) {
        $this->load->view('admin/users/create', $data);
    } else {
        $this->users_model->create_user($_POST);
        redirect('admin/users');
    }
}

public function edit($id) {
    $this->load->helper('form');
    $this->load->library('form_validation');

    

    $data['user'] = $this->users_model->get_user($id);
    $data['title'] = 'Edit user';

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() === FALSE) {
        $this->load->view('admin/users/edit', $data);
    } else {
        $this->users_model->update_user($id, $_POST);
        redirect('admin/users');
    }
}

public function delete($id) {
    $this->users_model->delete_user($id);
    redirect('admin/users');
    }

}