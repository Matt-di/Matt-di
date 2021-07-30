<?php
class UserOperation
{
    public $email;
    public $password;

    private $database;
    private $userTable;

    function __construct($database)
    {
        $this->database = $database;
        $this->userTable = "user";
    }

    public function loginUser()
    {
        $query = "SELECT * FROM " . $this->userTable .
            " WHERE email=?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $this->email);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (strcmp($row['password'], $this->password) == 0) {
                return array("message" => "User Successfully Logged", "status" => true);
            } else {
                return array("message" => "Please check your password!", "status" => false);
            }
        } else {
            return array("message" => "Incorrect Credential", "status" => false);
        }
    }
}
