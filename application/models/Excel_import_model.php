<?php
class Excel_import_model extends CI_Model
{
 function select()
 {
  $this->db->order_by('material_id', 'DESC');
  $query = $this->db->get('RawMaterial');
  return $query;
 }

 function insert($table,$data)
 {
  $this->db->insert_batch($data,$table);
 }
}