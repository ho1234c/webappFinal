<?php
class File_models extends CI_Model {
    function __construct()
    {       
        parent::__construct();
    }

    function add($option)
    {
        $this->db->set('product_image', $option['filename']);
        $this->db->set('marker_id', 'preparing');
        $this->db->insert('image');
        $result = $this->db->insert_id();
        return $result;
    }
}
?>