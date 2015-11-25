<?php

class ClassMoveModel {
	public $id;
	public $name;
	public $order;
	public $type;

	public function setid( $value=null ) {
		$this->id = $value;
	}

	public function getid() {
		return $this->id;
	}

	public function setName( $value=null ) {
		$this->name = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setOrder( $value=null ) {
		$this->order = $value;
	}

	public function getOrder() {
		return $this->order;
	}

	public function setType( $value=null ) {
		$this->type = $value;
	}

	public function getType() {
		return $this->type;
	}
	
}

?>