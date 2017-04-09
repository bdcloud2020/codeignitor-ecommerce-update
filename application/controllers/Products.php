<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function index() {

        $data['msg'] = '';
        $data['activetab'] = 'home';
        $data['sliders'] = $this->products_model->get_sliderimage();
        $data['getitem'] = $this->products_model->get_products();
        $this->load->view('products', $data);
    }

    public function detail($id) {

        $data['activetab'] = '';
        $data['sliders'] = $this->products_model->get_sliderimage();
        $data['det'] = $this->products_model->detail_products($id);
        $this->load->view('details', $data);
    }

    public function allitem() {
        $data['sliders'] = $this->products_model->get_sliderimage();

        $data['activetab'] = 'allitem';

        $config = [

            'base_url' => base_url('products/allitem'),
            'per_page' => 6,
            'total_rows' => $this->products_model->count_all_products(),
            'full_tag_open' => "<ul class='pagination pagination-lg'>",
            'full_tag_close' => "</ul>",
            "first_link" => "&laquo; First",
            'first_tag_open' => '<li class="prev page">',
            'first_tag_close' => '</li>',
            "last_link" => "Last &raquo;",
            'last_tag_open' => '<li class="next page">',
            'last_tag_close' => '</li>',
            'next_link' => 'Next &gt;',
            'next_tag_open' => '<li class="next page">',
            'next_tag_close' => '</li>',
            'prev_link' => '&lt; Previous',
            'prev_tag_open' => '<li class="prev page">',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li class="page">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => "<li class='active'><a>",
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);

        $data['alls'] = $this->products_model->all_products($config['per_page'], $this->uri->segment(3));


        //$data['alls'] = $this->products_model->all_products();
        $this->load->view('allitem', $data);
    }

    public function createaccount() {
        $data['sliders'] = $this->products_model->get_sliderimage();
        $data['activetab'] = 'createacc';
        $data['msg'] = '';
        $this->load->view('register', $data);
    }

    public function register() {

        $data['sliders'] = $this->products_model->get_sliderimage();

        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('username', 'User Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|trim');
        $this->form_validation->set_rules('pass', 'Password', 'required|trim');
        $this->form_validation->set_rules('mobno', 'Mobile No.', 'required|numeric|exact_length[10]|trim');

        $this->form_validation->set_error_delimiters("<div class='alert alert-dismissible alert-danger'> <strong>", " </strong></div>");

        if ($this->form_validation->run()) {   //if validation passes
            //success
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'pass' => md5($this->input->post('pass')),
                'mobno' => $this->input->post('mobno')
            );

            $success = $this->products_model->insert_account($data);

            if ($success) {


                //$data['activetab'] = 'createacc';
                $data['register'] = 'Your registration is Successful! You can Login Now! ';
                $this->session->set_flashdata('register', $data['register']);

                redirect('products', 'refresh');

                //$this->load->view('products', $data);
            } else {
                $data['activetab'] = 'createacc';
                $data['msg'] = 'There is Something Wrong, Please Try Again!';

                $this->load->view('register', $data);
            }
        } else {
            $data['activetab'] = 'createacc';
            $data['msg'] = '';

            $this->load->view('register', $data);
        }
    }

    public function order_complete() {
        $this->cart->destroy();

        $data['sliders'] = $this->products_model->get_sliderimage();

        $data['activetab'] = 'createacc';
        $data['ordersuccess'] = 'Your Order is Placed ! We will reach at your Door within 48 hr. Thank You !';
        

        $this->load->view('ordercomplete', $data);
    }

    

        public function login() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');



        if ($this->form_validation->run()) {   //if validation passes
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));



            $user_id = $this->products_model->login($username, $password);

            //Validate user
            if ($user_id) {
                //Create array of user data
                $data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );
                //Set session userdata
                $this->session->set_userdata($data);

                //Set message
                $this->session->set_flashdata('pass_login', 'You are logged In !');
                redirect('products');
            } else {
                //Set error
                $this->session->set_flashdata('fail_login', 'Username or Password is Incorrect, Please Try Again !');
                redirect('products');
            }
        } else {


            $this->session->set_flashdata('blanklogin', 'Username and Password Required to Login !');

            redirect('products');
        }
    }

    public function logout() {


        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();

        redirect('products');
    }

}
