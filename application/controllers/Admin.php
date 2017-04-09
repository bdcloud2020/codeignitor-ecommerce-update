<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {

        $this->load->view('admin/admin');
    }
    
    

    public function addproduct() {


        $data['msg'] = '';
        $this->load->view('admin/addprod', $data);
    }

    public function insertprod() {


        $this->form_validation->set_rules('prodname', 'Product Name', 'required');
        $this->form_validation->set_rules('prodprice', 'Product Price', 'required|numeric');
        $this->form_validation->set_rules('desc', 'Product Description', 'required');

        $this->form_validation->set_error_delimiters("<div class='alert alert-dismissible alert-danger'><strong>", "</strong></div>");


        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = '';

            $this->load->view('admin/addprod', $data);
        } else {
            // Upload Image
            $config['upload_path'] = './assets/image/items';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_size'] = '2048';
            //$config['max_width'] = '500';
            //$config['max_height'] = '500';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {

                $errors = array('error' => $this->upload->display_errors());


                $this->session->set_flashdata('error', $errors['error']);

                redirect('admin/addproduct', 'refresh');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $insert = $this->products_model->insert_prod($post_image);


            if ($insert) {


                $data['msg'] = 'Data Inserted Successfully!';

                $this->load->view('admin/addprod', $data);
            }
        }
    }

    public function editdeletepro() {


        $data['selectprods'] = $this->products_model->Admin_select_prod();

        $this->load->view('admin/editdeletepro', $data);
    }

    public function editproduct($editpro) {



        if ($editpro) {

            $data['msg'] = '';
            $data['editsingle'] = $this->products_model->admin_select_row($editpro);

            $this->load->view('admin/editproduct', $data);
        }
    }

    public function updateproduct() {

        $this->form_validation->set_rules('prodname', 'Product Name', 'required');
        $this->form_validation->set_rules('prodprice', 'Product Price', 'required|numeric');
        $this->form_validation->set_rules('desc', 'Product Description', 'required');

        $this->form_validation->set_error_delimiters("<div class='alert alert-dismissible alert-danger'><strong>", "</strong></div>");


        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = '';

            $this->load->view('admin/addprod', $data);
        } else {
            // Upload Image
            $config['upload_path'] = './assets/image/items';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_size'] = '2048';
            //$config['max_width'] = '500';
            //$config['max_height'] = '500';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = $this->input->post('oldimage');
            } else {
                
                 $oldimage = $this->input->post('oldimage');
                 unlink( FCPATH . "assets/image/items/".$oldimage );   //delete old image from folder
                 
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $update = $this->products_model->admin_update_prod($post_image);


            if ($update) {

                $this->session->set_flashdata('updatedata', 'Data updated Successfully !');
               // $data['msg'] = 'Data Updated Successfully!';

                //$this->load->view('admin/editproduct', $data);
                 redirect('admin/editdeletepro');
            }
        }
    }
    
    
    public function deleteproduct($deleteid){
        
         $query = $this->db->get_where('products', array('id' => $deleteid));
         $deletepro = $this->products_model->admin_delete_prod($deleteid);
           
         
         
         if($deletepro){
             
              

                  $imagename = $query->row()->image ;
                  
                 //$path = "assets/image/items/".$imagename;
                  
                  //echo $path; die;
                  
            
                     //delete_files($path);
                       
                      // echo $work; die;
                    
                   // echo $imagename; die;
                  
                  unlink( FCPATH . "assets/image/items/".$imagename );
                    
                   
             
                    $this->session->set_flashdata('deletedata', 'Data Deleted Successfully !');
                    redirect('admin/editdeletepro');
         }
         
        
        
    }
    
    public function login(){
        
        $this->load->view('admin/login');
    }
    
    public function login_valid(){
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');



        if ($this->form_validation->run()) {   //if validation passes
            $email = $this->input->post('email');
            $password = $this->input->post('password');



            $admin_id = $this->products_model->admin_login($email, $password);
            
           // print_r($admin_id); die;

            //Validate user
            if ($admin_id) {
                //Create array of user data
                $data = array(
                    'admin_id' => $admin_id,
                    'email' => $email,
                   
                );
                //Set session userdata
                $this->session->set_userdata($data);

                //Set message
                $this->session->set_flashdata('pass_login', 'You are logged In !');
                redirect('admin');
            } else {
                //Set error
                $this->session->set_flashdata('fail_login', 'Email or Password is Incorrect, Please Try Again !');
                redirect('admin/login');
            }
        } else {


            $this->session->set_flashdata('blanklogin', 'Username and Password Required to Login !');

           redirect('admin/login');
        }
    }

    
    
    public function admin_logout() {


        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();

        redirect('admin/login');
    }
    
}
