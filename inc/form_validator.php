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
        if ($fieldKey == "login") {
            $fields = $this->fields[$fieldKey];

            foreach($fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not parent in data");
                    return;
                }
            }

            $this->validateUsername();
        }
    }

    private function validateUsername()
    {
        $val = trim($this->data['username']);

        if (empty($val)) {
            $this->addError("username", "username cannot be empty");
        } else {
            if (preg_match('/^[a-zA-Z0-9]{1,255}$/', $val)) {
                # code...
            }
        }
    }

    private function validatePassword()
    {
        # code...
    }

    private function validateEmail()
    {
        # code...
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}