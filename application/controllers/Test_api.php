<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller 
{

    function index()
    {
        $this->load->view('register');
    }

    function action()
    {
        if($this->input->post('data_action'))
    {
    $data_action = $this->input->post('data_action');

    if($data_action == "Delete")
    {
        $api_url = "http://localhost/houspital/api/delete";

        $form_data = array(
            'id'  => $this->input->post('patient_id')
        );

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_POST, true);

        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        curl_close($client);

        echo $response;
    }

    if($data_action == "Edit")
    {
        $api_url = "http://localhost/houspital/api/update";

        $form_data = array(
            'first_name'  => $this->input->post('first_name'),
            'last_name'   => $this->input->post('last_name'),
            'birth_date'   => $this->input->post('birth_date'),
            'email'   => $this->input->post('email'),
            'phone'   => $this->input->post('phone'),
            'address'   => $this->input->post('address'),
            'city'   => $this->input->post('city'),
            'postcode'   => $this->input->post('postcode'),
            'reason'   => $this->input->post('reason'),
            'note'   => $this->input->post('note'),
            'sex'   => $this->input->post('sex'),
            'id'    => $this->input->post('patient_id')
        );

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_POST, true);

        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        curl_close($client);

        echo $response;
    }

    if($data_action == "fetch_single")
    {
        $api_url = "http://localhost/houspital/api/fetch_single";

        $form_data = array(
         'id'  => $this->input->post('patient_id')
        );

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_POST, true);

        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        curl_close($client);

        echo $response;
    }

    if($data_action == "Insert")
    {
        $api_url = "http://localhost/houspital/api/insert";

        $form_data = array(
            'first_name'  => $this->input->post('first_name'),
            'last_name'   => $this->input->post('last_name'),
            'birth_date'   => $this->input->post('birth_date'),
            'email'   => $this->input->post('email'),
            'phone'   => $this->input->post('phone'),
            'address'   => $this->input->post('address'),
            'city'   => $this->input->post('city'),
            'postcode'   => $this->input->post('postcode'),
            'reason'   => $this->input->post('reason'),
            'sex'   => $this->input->post('sex'),
            'note'   => $this->input->post('note')
        );

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_POST, true);

        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        curl_close($client);

        echo $response;
    }

    if($data_action == "fetch_all")
    {
        $api_url = "http://localhost/houspital/api";

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        curl_close($client);

        $result = json_decode($response);

        $output = '';

        if($result)
        {
            foreach($result as $row)
            {
                $output .= '
              <tr>
               <td>'.$row->patient_fname.'</td>
               <td>'.$row->patient_lname.'</td>
               <td>'.$row->patient_birthday.'</td>
               <td>'.$row->patient_email.'</td>
               <td>'.$row->patient_phone.'</td>
               <td>'.$row->patient_city.'</td>
               <td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->patient_id.'">Edit</button></td>
               <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->patient_id.'">Delete</button></td>
              </tr>';
            }
        }
        else
        {
            $output .= '
            <tr>
            <td colspan="4" align="center">No Data Found</td>
            </tr>';
        }

        echo $output;
    }
  }
 }
 
}

?>