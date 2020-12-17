<?php
class form_validator
{
    private $data;
    private $errors = [];
    private $fields = [
        "Login" => [
            "usernameLogin",
            "passwordLogin"
        ],
        "Register" => [
            "usernameRegister",
            "passwordRegister",
            "emailRegister"
        ],
        "submitBlog" => [
            "title",
            "decoration",
            "text"
        ]
    ];

    /**
     * takes all data from $_POST
     * 
     * @param array $post_data the data from $_POST
     */
    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    /**
     * control is a function where you tell it what to width the data
     * 
     * @param string $fieldKey login, register and submitBlog
     * 
     * @return array returns all errors found in checked fields 
     */
    public function validateForm($fieldKey)
    {
        $fields = $this->fields[$fieldKey];


        if ($fieldKey == "Login") {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            // check in these fields
            $this->validateUsername($fieldKey);
            $this->validatePassword($fieldKey);
        } else if ($fieldKey == "Register") {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            // check in these fields
            $this->validateUsername($fieldKey);
            $this->validatePassword($fieldKey);
            $this->validateEmail($fieldKey);
        } else if ($fieldKey == "submitBlog") {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            // check in these fields
            $this->validateBlog($fields);
        }

        // returns all errors found in checked fields 
        return $this->errors;
    }

    /**
     * validates a username after some condition
     * 
     * @param string $addErrorId is what field the error is in like login or register
     * 
     * @return void any errors in conditions is added to $this->errors;
     */
    private function validateUsername(string $addErrorId = "")
    {
        $val = trim($this->data["username$addErrorId"]);

        if ($addErrorId != "") {
            $addErrorId = ucfirst($addErrorId);
        }

        if (empty($val)) {
            $this->addError("username$addErrorId", "username cannot be empty");
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{6,255}$/', $val)) {
                $this->addError("username$addErrorId", "username must be 6-255 char & alphanumeric");
            }
        }
    }

    /**
     * validates a password after some condition
     * 
     * @param string $addErrorId is what field the error is in like login or register
     * 
     * @return void any errors in conditions is added to $this->errors;
     */
    private function validatePassword(string $addErrorId = "")
    {
        $val = trim($this->data["password$addErrorId"]);

        if ($addErrorId != "") {
            $addErrorId = ucfirst($addErrorId);
        }

        if (empty($val)) {
            $this->addError("password$addErrorId", "password cannot be empty");
        } else {
            if (strlen($val) <= 7) {
                $this->addError("password$addErrorId", "password must be 8 char or more");
            }
        }
    }

    /**
     * validates a email after some condition
     * 
     * @param string $addErrorId is what field the error is in like login or register
     * 
     * @return void any errors in conditions is added to $this->errors;
     */
    private function validateEmail(string $addErrorId = "")
    {
        $val = trim($this->data["email$addErrorId"]);

        if ($addErrorId != "") {
            $addErrorId = ucfirst($addErrorId);
        }

        if (empty($val)) {
            $this->addError("email$addErrorId", "email cannot be empty");
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError("email$addErrorId", "email must be a valid email");
            }
        }
    }

    /**
     * validates a blog after some condition
     * 
     * @param array $fields what field areas that need to be validated
     * 
     * @return void any errors in conditions is added to $this->errors;
     */
    private function validateBlog(array $fields)
    {
        foreach ($fields as $field) {
            $val = trim($this->data[$field]);

            if (empty($val)) {
                $this->addError($field . "Error", "$field cannot be empty");
            } else {
                if ($field == "title" && strlen($val) >= 50) {
                    $this->addError($field . "Error", "$field is max 50");
                } else if ($field == "decoration" && strlen($val) >= 50) {
                    $this->addError($field . "Error", "$field is max 50");
                } else if ($field == "text" && strlen($val) >= 500) {
                    $this->addError($field . "Error", "$field is max 500");
                }
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
    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
