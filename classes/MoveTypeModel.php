<?php
class MoveTypeModel {
	public $typeId;
	public $name;

	public function getTypeId() {
		return $this->typeId;
	}

	public function setTypeId( $value=null ) {
		$this->typeId = $value;
	}

	public function setName( $value=null ) {
		$this->name = $value;
	}

	public function getName() {
		return $this->name;
	}
}