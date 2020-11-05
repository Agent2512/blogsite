<?php
class form_validator {
    private $data;
    private $errors = [];
    private $fields = [
        "login" => [
            "username",
            "password"
        ],
        "register" => [
            "username",
            "password",
            "email"
        ]
    ];

    public function __construct($post_data){
        $this->data = $post_data;
    }

    public function validateForm($fieldKey){
        $fields = $this->fields[$fieldKey];

        if ($fieldKey == "login") {
            foreach($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            $this->validateUsername($fieldKey);
            $this->validatePassword($fieldKey);
        }
        else if ($fieldKey == "register") {
            foreach($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            $this->validateUsername($fieldKey);
            $this->validatePassword($fieldKey);
            $this->validateEmail($fieldKey);
        }

        return $this->errors;
    }

    private function validateUsername(string $addErrorId = "")
    {
        $val = trim($this->data['username']);

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

    private function validatePassword(string $addErrorId = "")
    {
        $val = trim($this->data['password']);

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

    private function validateEmail(string $addErrorId = "")
    {
        $val = trim($this->data['email']);

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

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}