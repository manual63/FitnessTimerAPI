<?php

class MoveModel.php {
	public $id;
	public $name;
	public $type;
	public $userId;

	public function getId() {
		return $this->id;
	}

	public function setId( $value=null ) {
		$this->id = $value;
	}

	public function setName( $value=null ) {
		$this->name = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setType( $value=null ) {
		$this->type = $value;
	}

	public function getType() {
		return $this->type;
	}

	public function setUserId( $value=null ) {
		$this->userId = $value;
	}

	public function getUserId() {
		return $this->userId;
	}
}



?>