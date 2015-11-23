<?php
require_once('../common/database/dbconnect.php');
require_once('UserModel.php');

class UserService {
	function getUsers() {

		$conn = dbconnect();

		$sql = "select * from users";

		$result = $conn->query($sql);

		$users = array();

		if ($result->num_rows > 0) {
		    // output data of each row

		    while($row = $result->fetch_assoc()) {
		       // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		        $userModel = new UserModel();

		        $userModel->setId( $row['ID'] );
		        $userModel->setFirstName( $row['FIRST_NAME'] );
		        $userModel->setLastName( $row['LAST_NAME'] );
		        $userModel->setEmailAddress( $row['EMAIL_ADDRESS'] );
		        $userModel->setPassword( $row['PASSWORD'] );

		        array_push($users, $userModel);
		    }
		} else {
		    echo "0 results";
		}

		dbDisconnect( $conn );
		return $users;
	}

	function getUser( $id=null ) {

		$conn = dbconnect();

		$sql = "select * from users where id = $id";

		$result = $conn->query($sql);

		$userModel = new UserModel();

		if ($result->num_rows > 0) {
		    // output data of each row

		    while($row = $result->fetch_assoc()) {
		        $userModel->setId( $row['ID'] );
		        $userModel->setFirstName( $row['FIRST_NAME'] );
		        $userModel->setLastName( $row['LAST_NAME'] );
		        $userModel->setEmailAddress( $row['EMAIL_ADDRESS'] );
		        $userModel->setPassword( $row['PASSWORD'] );
		    }
		} else {
		    echo "0 results";
		}

		dbDisconnect( $conn );
		return $userModel;
	}

	function validateUser( $emailAddress, $password ) {

		$conn = dbconnect();

		$sql = 'select * from users where EMAIL_ADDRESS="' . $emailAddress . '" and PASSWORD=password("' . $password . '")';

		$result = $conn->query($sql);

		$userModel = new UserModel();

		if ($result->num_rows > 0) {
		    // output data of each row

		    while($row = $result->fetch_assoc()) {
		        $userModel->setId( $row['ID'] );
		        $userModel->setFirstName( $row['FIRST_NAME'] );
		        $userModel->setLastName( $row['LAST_NAME'] );
		        $userModel->setEmailAddress( $row['EMAIL_ADDRESS'] );
		        $userModel->setPassword( $row['PASSWORD'] );
		    }
		} else {
		    echo "0 results";
		}

		dbDisconnect( $conn );
		return $userModel;
	}

	function createUser( $data ) {
		$conn = dbconnect();

		$sql = 'insert into users (first_name, last_name, email_address, password)'
			. ' values ("' . $data[0]->value . '", "' . $data[1]->value . '", "' . $data[2]->value . '", password("' . $data[3]->value . '"))';

		if ($conn->query($sql) === TRUE) {
		    return $sql;
		} else {
		    return "Error: " . $sql . "<br>" . $conn->error;
		}

		dbDisconnect( $conn );
	}

	function updateUser( $data, $id ) {
		$conn = dbconnect();

		$sql = 'update users set first_name="' . $data[0]->value . '", last_name="' . $data[1]->value . '", email_address="' . $data[2]->value . '" where id=$id';

		if ($conn->query($sql) === TRUE) {
		    return $sql;
		} else {
		    return "Error: " . $sql . "<br>" . $conn->error;
		}

		dbDisconnect( $conn );
	}

	function deleteUser( $id ) {
		$conn = dbconnect();

		$sql = 'delete from users where id=' . $id;

		if ($conn->query($sql) === TRUE) {
		    return $sql;
		} else {
		    return "Error: " . $sql . "<br>" . $conn->error;
		}

		dbDisconnect( $conn );
	}
}


?>