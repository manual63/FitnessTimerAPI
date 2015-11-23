<?php
require_once('ClassService.php');

use \Jacwright\RestServer\RestException;

header('Access-Control-Allow-Origin: http://www.fitnesstimer.dev');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, X-Custom-Header');
header('Access-Control-Allow-Credentials: true');

class ClassController
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url GET /
     */
    public function test() {
        return "Hello World";
    }

    /**
     * Gets the user by id or current user
     *
     * @url GET fitnessclass
     */
    public function initFitnessClass() {
        return "Init Class"; // serializes object into JSON
    }

    /**
     * Gets the user by id or current user
     *
     * @url POST /fitnessclass
     */
    public function createFitnessClass( $data ) {
        $classService = new ClassService();

        $classService->createClass( $data );
        return "Create Class"; // serializes object into JSON
    }

    /**
    * Gets all classes for a user
    *
    * @url GET /getfitnessclasses/$id
    */
    public function getFitnessClasses( $id = null ) {
        $result = new stdClass();
        if ( $id !== null ) {
            $classService = new ClassService();
            $fitnessClasses = $classService->getFitnessClasses( $id );

            $result->fitnessClasses = $fitnessClasses;
            return $result;
        }
        else {
            return "Need a user id!";
        }
    }

    /**
    * Creates a move and adds it to a class
    *
    * @url POST /addclassmove/$classId
    */

    public function addClassMove( $classId = null, $data ) {
        $result = new stdClass();

        if( $classId !== null ) {
            $classService = new ClassService();
            $classMoves = $classService->createClassMove( $classId, $data );

            $result->classMoves = $classMoves;
        }
    }

    /**
     * Gets the user by id or current user
     *
     * @url GET /class/$id
     * @url GET /class/current
     */
    public function getClass( $id = null ) {
        // if ($id) {
        //     $user = User::load($id); // possible user loading method
        // } else {
        //     $user = $_SESSION['user'];
        // }

        return array("id" => $id, "name" => null); // serializes object into JSON
    }

    /**
     * Gets the list of class moves
     *
     * @url GET /classmoves/$id
     * @url GET /classmoves/current
     */
    public function getClassMoves($id = null) {
        // if ($id) {
        //     $user = User::load($id); // possible user loading method
        // } else {
        //     $user = $_SESSION['user'];
        // }

        return array("id" => $id, "name" => null); // serializes object into JSON


            // select class.name, move.name as move, move_type.NAME as type from class
            // inner join class_move
            // on class.id = class_move.CLASS_ID
            // inner join move
            // on move.id = class_move.MOVE_ID
            // inner join move_type
            // on move.TYPE_ID = move_type.ID
    }



    /**
     * Saves a user to the database
     *
     * @url POST /class
     * @url PUT /class/$id
     */
    public function saveClass($id = null, $data) {
        // ... validate $data properties such as $data->username, $data->firstName, etc.
        // $data->id = $id;
        // $user = User::saveUser($data); // saving the user to the database
        $user = array("id" => $id, "name" => null);
        return $user; // returning the updated or newly created user object
    }

    /**
     * Get Charts
     * 
     * @url GET /charts
     * @url GET /charts/$id
     * @url GET /charts/$id/$date
     * @url GET /charts/$id/$date/$interval/
     * @url GET /charts/$id/$date/$interval/$interval_months
     */
    public function getCharts($id=null, $date=null, $interval = 30, $interval_months = 12) {
        echo "$id, $date, $interval, $interval_months";
    }

    /**
     * Throws an error
     * 
     * @url GET /error
     */
    public function throwError() {
        throw new RestException(401, "Empty password not allowed");
    }
}