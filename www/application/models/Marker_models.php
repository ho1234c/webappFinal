<?php
class Marker_models extends CI_Model {
    function __construct()
    {       
        parent::__construct();
    }

    function add($option)
    {
        $this->db->set('lat', $option['lat']);
        $this->db->set('lng', $option['lng']);
        $this->db->set('image', $option['filename']);
        $this->db->set('user_id', $option['user_id']);
        $this->db->insert('marker');
        $result = $this->db->insert_id();
        return $result;
    }

    function getByUserId($option)
    {
        $result = $this->db->get_where('marker', array('user_id'=>$option['user_id']))->result_array();
        return $result;
    }
}
?>