
<?php
/**
 * @author Mattih
 * this class is used for performing operations carried out by user
 * 
 */
class UserOperation
{
    public $email;
    public $password;

    private $database;
    private $userTable;
	
	public $longitude;
	public $latitude;

    function __construct($database)
    {
        $this->database = $database;
        $this->userTable = "user";
    }

    /**
     * For authenticating user 
     * @param password - user password
     * @param email - user email
     * @return message - status of the operation
     * <p> I'm using this function for the RESTful operation
     * through web app and android app. It is called from @var User </p>
     */
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

    /**
     * For updating field location 
     * @return message - about status of the operation
     */
    public function updateLocation()
    {
        $query = "UPDATE field 
        SET field_latitude=?,field_longitude=? WHERE field_id=1";

    $stmt = $this->database->prepare($query);
    $stmt->bind_param("dd", $this->latitude,$this->longitude);
    
    $affec = $stmt->execute();
    if($affec>0)
    return true;
    else return false;
    }

}
