<?php

class BaseService{

    protected $dao;

    public function getByID($id){
        return $this->dao->getByID($id);
    }
    
    public function add($data){
        return $this->dao->add($data);
    }

    public function update($id, $data){
        $this->dao->update($id, $data);
        return $this->dao->getByID($id);
    }
}
?>