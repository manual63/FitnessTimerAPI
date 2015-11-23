<?php
require_once('ClassModel.php');
require_once('../common/database/dbconnect.php');
class ClassService {
	public function createClass( $data ) {
		$conn = dbconnect();
		$last_id = null;

		$sql = 'insert into class (name)'
			. ' values ("' . $data->name . '")';

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
		} else {
		    return "Error: " . $sql . "<br>" . $conn->error;
		}

		if( $last_id !== null ) {
			$sql = 'insert into user_class (user_id, class_id)'
				. 'values (' . $data->userId . ', ' . $last_id . ')';

			if ($conn->query($sql) === TRUE) {
			    return "Success";
			} else {
			    return "Error: " . $sql . "<br>" . $conn->error;
			}		
		}

		dbDisconnect( $conn );
	}

	public function getFitnessClasses( $id=null ) {

		if( $id !== null ) {
			$conn = dbconnect();

			$sql = 'select class.ID, class.NAME from class'
				. ' inner join user_class on user_class.CLASS_ID = class.ID'
				. ' inner join users on user_class.USER_ID = users.ID'
				. ' where users.ID = ' . $id;

			$result = $conn->query($sql);

			$classes = Array();

			if ($result->num_rows > 0) {
			    // output data of each row
				
			    while($row = $result->fetch_assoc()) {
			       // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			        $classModel = new ClassModel();

			        $classModel->setUserId( $id );
			        $classModel->setClassId( $row['ID'] );
			        $classModel->setName( $row['NAME'] );

			        array_push($classes, $classModel);
			    }
			} else {
			    echo "0 results";
			}

			dbDisconnect( $conn );
			return $classes;
		}
	}

	public function createClassMove( $classId, $data ) {
		if( $clasId !== null ) {
			$conn = dbconnect();
			$lastId = null;
			$result = null;

			$sql = 'insert into move (NAME, TYPE_ID)'
				. ' values( "' . $data->name . '", ' . data->typeId . ')';

			if ($conn->query($sql) === TRUE) {
				$lastId = $conn->insert_id;
			} else {
			    return "Error: " . $sql . "<br>" . $conn->error;
			}

			if( $lastId !== null ) {
				$sql = 'insert into class_move (CLASS_ID, MOVE_ID, CLASS_ORDER)'
					. ' values(' . $classId . ', ' . $lastId . ', ' . $data->classOrder . ')';

				if ($conn->query($sql) === TRUE) {
					$result = "Success";
				} else {
					return "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			return $result;

			dbDisconnect( $conn );
		}
	}
}
?>