<?php
class SidePanel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	/**
	* Log in functionality goes here
	*/

    //===============Get all parent management from table==============//
    function getAllManagement()
    {
        $this->db->where('sidePanelStatus',1);
        $this->db->where('sidePanelParent',0);
        $query=$this->db->get('sidePanel');
        return $query->result();
    }
    
     //==========fetch all child navigations from article table===========//
    function get_childnav_value($parent_menu)
    {
        $this->db->from('sidePanel');
        $this->db->where('sidePanelParent', $parent_menu);
        $this->db->where('sidePanelStatus', '1');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $val = $query->result();
            return $val;
        }
    }
}
?>