<?php
class mysql {
    private $conn;
    // constants a standard connection to database 
    public function __construct($inputServerName = "localhost", $inputUserName = "root", $inputPassword = "", $inputDatabase = "blogsite") {
        $this->conn = new mysqli($inputServerName, $inputUserName, $inputPassword, $inputDatabase);

        if ($this->conn->connect_error){
            die("Error connecting "  . $this->conn->connect_error);
            return false;
        }
        else{
            return true;
        }
    }
    // gets data from database and returns is array if successful if not returns false
    public function getData($inputSqlQuery = "")
    {
        $result = $this->conn->query($inputSqlQuery);
        $sqlData = [];
        
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                array_push($sqlData, $row);
            }
        }

        if (count($sqlData) != 0) {
            return $sqlData;
        }
        else{
            return false;
        }
    }

    // takes string and runs it on database if no Error returns true else if Error returns false
    private function run($inputSqlQuery = "")
    {
        $result = $this->conn->query($inputSqlQuery);

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    // makes runs public and reNames to make esay identify action in code
    public function deleteData($inputSqlQuery = ""){
        return $this->run($inputSqlQuery);
    }
    public function createData($inputSqlQuery = ""){
        return $this->run($inputSqlQuery);
    } 
    public function updateData($inputSqlQuery = ""){
        return $this->run($inputSqlQuery);
    }
}
?>