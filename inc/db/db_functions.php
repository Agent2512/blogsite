<?php
class db_functions extends db_connection
{
    public function getAllUsers()
    {
        return $this->getData("
            SELECT * FROM `login`
        ");
    }

    public function createUser(string $username, string $password, string $email)
    {
        return $this->createData("
        INSERT INTO `login` (`id`, `username`, `password`, `email`) VALUES (NULL, '$username', '$password', '$email');
        ");
    }

    // 

    public function getAllCategories()
    {
        return $this->getData("SELECT * FROM `categories`");
    }
}
