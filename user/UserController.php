<?php
require_once('UserService.php');

use \Jacwright\RestServer\RestException;

header('Access-Control-Allow-Origin: http://www.fitnesstimer.dev');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, X-Custom-Header');
header('Access-Control-Allow-Credentials: true');

class UserController
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
     *
     * @url GET test
     */
    public function testing() {
        return "This is a test!";
    }

    /**
     *
     * @url POST test/$id
     */
    public function testpost( $id=null ) {
        if($id !== null) {
            return "test id = $id";
        }
        else {
            return "No ID passed in this test!";
        }
    }

    /**
    * Initializes login
    *
    * @url GET /login
    */
    public function intiLogin() {
        return "Initialized";
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     */
    public function login( $data ) {
        $userService = new UserService();
        if( $data !== null ) {
            $user = $userService->validateUser( $data->emailAddress, $data->password );

            return $user;
        }
        // $username = $_POST['username'];
        // $password = $_POST['password']; //@todo remove since it is not needed anywhere
        // return array("success" => "Logged in " . $username);
    }

        /**
     * Gets all users
     *
     * @url GET /users
     */
    public function getUsers() {
        $result = new stdClass();
        $userService = new UserService();

        $result->users = $userService->getUsers();

        return $result;
    }

    /**
     * Gets the user by id
     *
     * @url GET /user/$id
     */
    public function getUser($id = null) {
        $userService = new UserService();

        $user = $userService->getUser( $id );

        return $user;
    }

    /**
     *
     * @url POST save
     * @url PUT save/$id
     */
    public function saveUser( $id=null, $data ) {

        $userService = new UserService();

        if( $id === null ) {
            $user = $userService->createUser( $data );
            return $user;
        }
        else {
            return "Update User with id = $id";
        }
        
    }

    /**
     *
     * @url DELETE deleteuser/$id
     */
    public function deleteUser( $id=null ) {
        $userService = new UserService();

        if( $id !== null ) {
            $user = $userService->deleteUser( $id );
            return $user;
        }
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