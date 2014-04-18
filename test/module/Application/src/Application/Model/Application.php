<?php
 namespace Application\Model;

 class Application
 {
     public $id;
 public $time;
 public $type;
 public $category;

 public function exchangeArray($data)
 {
         $this->id = (!empty($data['id'])) ? $data['id'] : null;
 $this->time = (!empty($data['time'])) ? $data['time'] : null;
 $this->type = (!empty($data['type'])) ? $data['type'] : null;
 $this->category = (!empty($data['category'])) ? $data['category'] : null;
 }
 }