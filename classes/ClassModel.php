<?php
class ClassModel {
	public $userId;
	public $classId;
	public $name;

	public function setUserId( $value=null ) {
		$this->userId = $value;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setClassId( $value=null ) {
		$this->classId = $value;
	}

	public function getClassId() {
		return $this->classId;
	}

	public function setName( $value=null ) {
		$this->name = $value;
	}

	public function getName() {
		return $this->name;
	}

}
?>