<?php
class mysqlScripts extends mysql
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
}
