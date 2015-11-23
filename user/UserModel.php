<?php
	class UserModel {
		public $id;
		public $firstName;
		public $lastName;
		public $emailAddress;
		public $password;

		public function setId( $value=null ) {
			$this->id = $value;
		}

		public function getId() {
			return $this->id;
		}

		public function setFirstName( $value=null ) {
			$this->firstName = $value;
		}

		public function getFirstName() {
			return $this->firstName;
		}

		public function setLastName( $value=null ) {
			$this->lastName = $value;
		}

		public function getLastName() {
			return $this->lastName;
		}
		public function setEmailAddress( $value ) {
			$this->emailAddress = $value;
		}

		public function getEmailAddress() {
			return $this->emailAddress;
		}
		public function setPassword( $value ) {
			$this->password = $value;
		}

		public function getPassword() {
			return $this->password;
		}

	}
?>