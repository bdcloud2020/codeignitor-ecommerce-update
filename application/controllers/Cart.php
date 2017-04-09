<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public $paypal_data = '';
    public $tax;
    public $shipping;
    public $total = 0;
    public $grand_total;

    /*
     * 	Cart Index
     */

    public function index() {
        //Load View
        $data['sliders'] = $this->products_model->get_sliderimage();
        $data['activetab'] = 'home';
        $this->load->view('cart', $data);
    }

    /*
     * Add To Cart
     */

    public function add() {
        //Item Data
        $data = array(
            'id' => $this->input->post('item_number'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('title'),
            'size' => $this->input->post('size')
        );
        //print_r($data);die();
        //Insert Into Cart
        $this->cart->insert($data);

        redirect('cart');
    }

    /*
     * Update Cart
     */

    public function update($in_cart = null) {
        $data = $_POST;
        $this->cart->update($data);

        //Show Cart Page
        redirect('cart');
    }
    
    
    

    /*
     * 	Process Form
     */

    public function process() {

        $this->form_validation->set_rules('add1', 'Address', 'required|trim');
        $this->form_validation->set_rules('state', 'State', 'required|trim');
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $this->form_validation->set_rules('cod', 'Payment Mode', 'required');

        $this->form_validation->set_rules('mobno', 'Mobile No.', 'required|numeric|exact_length[10]|trim');
        $this->form_validation->set_error_delimiters("<div class='alert alert-dismissible alert-danger'><strong>", "</strong></div>");

        if ($this->form_validation->run()) {   //if validation passes

            if ($_POST) {
                foreach ($this->input->post('item_name') as $key => $value) {
                    //Get tax & shipping from config
                    $this->tax = $this->config->item('tax');
                    $this->shipping = $this->config->item('shipping');

                    $item_id = $this->input->post('item_code')[$key];
                    $item_size = $this->input->post('item_size')[$key];
                    $product = $this->products_model->get_product_details($item_id);

                    //Price x Quanity
                    $subtotal = ($product->price * $this->input->post('item_qty')[$key]);
                    $this->total = $this->total + $subtotal;


                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d H:i:s');

                    //Create Order Array
                    $order_data = array(
                        'product_id' => $item_id,
                        'product_size' => $item_size,
                        'user_id' => $this->session->userdata('user_id'),
                        'transaction_id' => 0,
                        'qty' => $this->input->post('item_qty')[$key],
                        'price' => $subtotal,
                        'address' => $this->input->post('add1'),
                        'address2' => $this->input->post('add2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'mobile' => $this->input->post('mobno'),
                        'paymode' => $this->input->post('cod'),
                        'date' => $date
                       
                    );

                    //Add Order Data
                    $this->products_model->add_order($order_data);
                }

                $order_total = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'grandtotal' => $this->input->post('grandtotal'),
                    'date' => $date
                );

                $this->products_model->user_order_total($order_total);


                redirect('products/order_complete');
            }
        } else {

            $data['sliders'] = $this->products_model->get_sliderimage();
            $data['activetab'] = 'home';
            $this->load->view('cart', $data);
        }
    }

}
