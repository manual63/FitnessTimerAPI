<?php
require_once('ClassModel.php');
require_once('ClassMoveModel.php');
require_once('MoveTypeModel.php');
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

	public function createClassMove( $data=null ) {
		if( $data !== null ) {
			$conn = dbconnect();
			$lastId = null;
			$result = null;

			$sql = 'insert into move (NAME, TYPE_ID, USER_ID)'
				. ' values( "' . $data->name . '", ' . $data->typeId . ', ' .$data->userId . ')';

			if ($conn->query($sql) === TRUE) {
				$lastId = $conn->insert_id;
			} else {
			    return "Error: " . $sql . "<br>" . $conn->error;
			}

			if( $lastId !== null ) {
				$sql = 'insert into class_move (CLASS_ID, MOVE_ID, MOVE_ORDER)'
					. ' values(' . $data->classId . ', ' . $lastId . ', ' . $data->order . ')';

				if ($conn->query($sql) === TRUE) {
					$result = "Success";
				} else {
					return "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			dbDisconnect( $conn );

			return $this->getClassMoves( $data->classId );
		}
	}

	public function getClassMoves( $classId=null ) {
		if( $classId !== null ) {
			$conn = dbconnect();

			$sql = 'select move.ID as id, move.NAME as name, move.USER_ID as userid, class_move.MOVE_ORDER as moveorder, move_type.NAME as type from move'
			 . ' inner join move_type on move_type.ID = move.TYPE_ID'
			 . ' inner join class_move on class_move.MOVE_ID = move.ID'
			 . ' where class_move.CLASS_ID = ' . $classId;

			$result = $conn->query($sql);

			$classMoves = Array();

			if ($result->num_rows > 0) {
			    // output data of each row
				
			    while($row = $result->fetch_assoc()) {
			    	$classMove = new ClassMoveModel();

			    	$classMove->setId( $row["id"] );
			    	$classMove->setName( $row["name"] );
			    	$classMove->setType( $row["type"] );
			    	$classMove->setOrder( $row["moveorder"] );

			    	array_push( $classMoves, $classMove );

			    }
			}

			dbDisconnect( $conn );

			return $classMoves;
		}
	}

	public function removeClassMove( $moveId, $classId ) {
		$conn = dbconnect();

		$sql = 'delete from class_move'
			. ' where CLASS_ID = ' . $classId
			. ' and MOVE_ID = ' . $moveId;

		if ($conn->query($sql) === TRUE) {
			dbDisconnect( $conn );
			return "Success";
		} else {
			dbDisconnect( $conn );
		    return "Error: " . $sql . "<br>";
		}
	}

	public function getMoveTypes() {
		$conn = dbconnect();

		$sql = 'select * from move_type order by NAME';

		$result = $conn->query($sql);
		$moveTypes = Array();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$moveTypeModel = new MoveTypeModel();

				$moveTypeModel->setTypeId( $row["ID"] );
				$moveTypeModel->setName( $row["NAME"] );

				array_push($moveTypes, $moveTypeModel);
			}
		}

		dbDisconnect( $conn );

		return $moveTypes;
	}

	public function updateMoveOrder( $classId, $data ) {
		$conn = dbconnect();
		$result;

		foreach( $data as $classMove ) {
			$sql = 'update class_move set MOVE_ORDER = ' . $classMove->moveOrder
				. ' where CLASS_ID = ' . $classId
				. ' and MOVE_ID = ' .$classMove->moveId;

			if ($conn->query($sql) === TRUE) {
				$result = 'Success';
			}
			else {
				$result = 'Failed! SQL = ' . $sql;
			}
		}

		dbDisconnect( $conn );
		return $result;
	}
}
?>