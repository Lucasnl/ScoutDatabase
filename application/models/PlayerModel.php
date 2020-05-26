<?php


class PlayerModel extends CI_Model{
  
  public function get_dados(){
        if(!empty($this->input->get("search"))){
          $this->db->like('summonerName', $this->input->get("search"));
          $this->db->like('summonerId', $this->input->get("search"));
          $this->db->like('accountId', $this->input->get("search")); 
          $this->db->like('puuId', $this->input->get("search")); 
        }
        $query = $this->db->get("cadastro");
        return $query->result();
    }
}
	?>