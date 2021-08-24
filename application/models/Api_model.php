<?php
class Api_model extends CI_Model
{
    function fetch_all()
    {
        $this->db->order_by('patient_id', 'DESC');
        return $this->db->get('tbl_patients');
    }

    function insert_api($data)
    {
        $this->db->insert('tbl_patients', $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function fetch_single_user($patientId)
    {
        $this->db->where("patient_id", $patientId);
        $query = $this->db->get('tbl_patients');
        return $query->result_array();
    }

    function update_api($patientId, $data)
    {
        $this->db->where("patient_id", $patientId);
        $this->db->update("tbl_patients", $data);
    }
 
    function delete_single_user($patientId)
    {
        $this->db->where("patient_id", $patientId);
        $this->db->delete("tbl_patients");
        if($this->db->affected_rows() > 0)
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

}