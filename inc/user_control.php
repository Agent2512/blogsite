<?php
class user_control {
    private $db;
    private $data;
    private $errors = [];

    /**
     * takes all data from $_POST
     * 
     * @param array $post_data the data from $_POST
     */
    public function __construct(array $post_data = []){
        $this->data = $post_data;

        $this->db = new db_functions();

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * deletes a user in the database
     * 
     * @param string $user_id the ID of the user
     */
    public function userDelete(string $user_id)
    {
        $this->db->userDelete($user_id);
    }

    /**
     * approves a user in the database
     * 
     * @param string $user_id the ID of the user
     */
    public function userApprove(string $user_id)
    {
        $this->db->userApprove($user_id);
    }

    /**
     * get a user in database
     * 
     * @return false|array returns false if an error occurred or the return form database is empty,
     * returns array if database return is one or more items
     */
    public function getAllUsers()
    {
        return $this->db->getAllUsers();
    }

    /**
     * control is a function where you tell it what to width the data
     * 
     * @param string $control login or register
     */
    public function control(string $control)
    {
        if ($control == "Login") {
            $this->login();
        }
        else if ($control == "Register") {
            $this->register();
        }

        return $this->errors;
    }

    /**
     * logs a user in
     */
    private function login()
    {
        $username = strtolower($this->data["usernameLogin"]);
        $password =  $this->data["passwordLogin"];

        $allUsers = $this->db->getAllUsers();
        $allUsernames = array_column($allUsers, 'username');
        $allPasswords = array_column($allUsers, 'password');
        
        if (!in_array($username, $allUsernames)) {
            $this->addError("usernameLogin", "unknown username");
        }
        else {
            $userIndex = array_search($username, $allUsernames);

            if (!password_verify($password, $allPasswords[$userIndex])) {
                $this->addError("passwordLogin", "invalid password");
            }
            else {
                if ($allUsers[$userIndex]["approved"] == 0) {
                    $this->addError("notApproved", "not approved user");
                }
                else {
                    $_SESSION["username"] = $username;
                }
            }
        }
    }

    /**
     * registers a user in database
     */
    private function register()
    {
        $email = $this->data["emailRegister"];
        $username = strtolower($this->data["usernameRegister"]);
        $password = password_hash($this->data["passwordRegister"], PASSWORD_DEFAULT);

        $allUsers = $this->db->getAllUsers();
        $allUsernames = array_column($allUsers, 'username');
        $allEmails = array_column($allUsers, 'email');

        if (in_array($email, $allEmails)) {
            $this->addError("emailRegister", "Email already in use");
        }
        else {
            if (in_array($username, $allUsernames)) {
                $this->addError("usernameRegister", "username already in use");
            }
            else {
                $this->db->createUser($username, $password, $email);
            }
        }
    }

    /**
     * adds errors to return array
     * 
     * @param string $kay what field is the error in
     * 
     * @param string $val the error message
     * 
     * @return array all found in fields
     */
    private function addError(string $key, string $val)
    {
        $this->errors[$key] = $val;
    }
}