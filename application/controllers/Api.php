<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data = $this->api_model->fetch_all();
        echo json_encode($data->result_array());
    }
 
    function insert()
    {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("last_name", "Last Name", "required");
        $this->form_validation->set_rules("birth_date", "Birth date", "required");
        $this->form_validation->set_rules("email", "Email address", "required");
        $this->form_validation->set_rules("phone", "Phone", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("city", "City", "required");
        $this->form_validation->set_rules("postcode", "Postcode", "required");
        $this->form_validation->set_rules("reason", "Reason of registration", "required");
        $this->form_validation->set_rules("sex", "Sex", "required");
        $array = array();
        if($this->form_validation->run())
        {
            $data = array(
                'patient_fname' => trim($this->input->post('first_name')),
                'patient_lname'  => trim($this->input->post('last_name')),
                'patient_birthday'  => trim($this->input->post('birth_date')),
                'patient_email'  => trim($this->input->post('email')),
                'patient_phone'  => trim($this->input->post('phone')),
                'patient_address'  => trim($this->input->post('address')),
                'patient_city'  => trim($this->input->post('city')),
                'patient_postcode'  => trim($this->input->post('postcode')),
                'patient_reason'  => trim($this->input->post('reason')),
                'patient_note'  => trim($this->input->post('note')),
                'patient_sex'  => trim($this->input->post('sex'))
            );
            $this->api_model->insert_api($data);
            $array = array(
                'success'  => true
            );
        }
        else
        {
            $array = array(
                'error'    => true,
                'first_name_error' => form_error('first_name'),
                'last_name_error' => form_error('last_name'),
                'birth_date_error' => form_error('birth_date'),
                'email_error' => form_error('email'),
                'phone_error' => form_error('phone'),
                'address_error' => form_error('address'),
                'city_error' => form_error('city'),
                'postcode_error' => form_error('postcode'),
                'reason_error' => form_error('reason'),
                'sex_error' => form_error('sex')
            );
        }
        echo json_encode($array, true);
    }

    function fetch_single()
    {
        if($this->input->post('id'))
        {
            $data = $this->api_model->fetch_single_user($this->input->post('id'));
            foreach($data as $row)
            {
                $output['first_name'] = $row["patient_fname"];
                $output['last_name'] = $row["patient_lname"];
                $output['birth_date'] = $row["patient_birthday"];
                $output['email'] = $row["patient_email"];
                $output['phone'] = $row["patient_phone"];
                $output['address'] = $row["patient_address"];
                $output['city'] = $row["patient_city"];
                $output['postcode'] = $row["patient_postcode"];
                $output['reason'] = $row["patient_reason"];
                $output['note'] = $row["patient_note"];
                $output['sex'] = $row["patient_sex"];
            }
            echo json_encode($output);
        }
    }

    function update()
    {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("last_name", "Last Name", "required");
        $this->form_validation->set_rules("birth_date", "Birth date", "required");
        $this->form_validation->set_rules("email", "Email address", "required");
        $this->form_validation->set_rules("phone", "Phone", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("city", "City", "required");
        $this->form_validation->set_rules("postcode", "Postcode", "required");
        $this->form_validation->set_rules("reason", "Reason of registration", "required");
        $this->form_validation->set_rules("sex", "Sex", "required");
        $array = array();
        if($this->form_validation->run())
        {
            $data = array(
                'patient_fname' => trim($this->input->post('first_name')),
                'patient_lname'  => trim($this->input->post('last_name')),
                'patient_birthday'  => trim($this->input->post('birth_date')),
                'patient_email'  => trim($this->input->post('email')),
                'patient_phone'  => trim($this->input->post('phone')),
                'patient_address'  => trim($this->input->post('address')),
                'patient_city'  => trim($this->input->post('city')),
                'patient_postcode'  => trim($this->input->post('postcode')),
                'patient_reason'  => trim($this->input->post('reason')),
                'patient_note'  => trim($this->input->post('note')),
                'patient_sex'  => trim($this->input->post('sex'))
            );
            $this->api_model->update_api($this->input->post('id'), $data);
            $array = array(
                'success'  => true
            );
        }
        else
        {
            $array = array(
                'error'    => true,
                'first_name_error' => form_error('first_name'),
                'last_name_error' => form_error('last_name'),
                'birth_date_error' => form_error('birth_date'),
                'email_error' => form_error('email'),
                'phone_error' => form_error('phone'),
                'address_error' => form_error('address'),
                'city_error' => form_error('city'),
                'postcode_error' => form_error('postcode'),
                'reason_error' => form_error('reason'),
                'sex_error' => form_error('sex')
            );
        }
        echo json_encode($array, true);
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            if($this->api_model->delete_single_user($this->input->post('id')))
            {
                $array = array(
                    'success' => true
                );
            }
            else
            {
                $array = array(
                    'error' => true
                );
            }
            echo json_encode($array);
        }
    }
 
}