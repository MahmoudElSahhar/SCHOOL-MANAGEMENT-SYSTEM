<?php

class User implements iObserver{
    public $ID;
    public $fullName;
    public $nationalityID;
    public $DOB;
    public $placeOfBirth;
    public $addresses; //array
    public $links; //array
    public $telephones; //array
    public $username;
    public $password;
    public $userTypeID;
    public $isAccepted;
    public $values; //array
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("user", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->fullName = $row['FullName'];
                $this->nationalityID = new Type($row['NationalityID']);
                $this->DOB = $row['DOB'];
                $this->placeOfBirth = $row['PlaceOfBirth'];
                $this->username = $row['Username'];
                $this->password = $row['Password'];
                $this->userTypeID = $row['UserTypeID'];
                $this->isAccepted = $row['IsAccepted'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];

                $result = $db->selectWhere("user_address", "UserID=".$ID);
                if($result != NULL){
                    $this->addresses = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result))
                    {
                        $this->addresses[$i] = new UserAddress($row['ID']);
                        $i++;
                    }
                }

                $result = $db->selectWhere("permission", "UserTypeID=".$this->userTypeID);
                if($result != NULL){
                    $this->links = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result))
                    {
                        $this->links[$i] = new Link($row['LinkID']);
                        $i++;
                    }
                }

                $result = $db->selectWhere("user_telephone", "UserID=".$ID);
                if($result != NULL){
                    $this->telephones = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result))
                    {
                        $this->telephones[$i] = new UserTelephone($row['ID']);
                        $i++;
                    }
                }

                $result = $db->selectWhere("user_type_option_value", "UserID=".$ID);
                if($result != NULL){
                    $this->values = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result))
                    {
                        $this->values[$i] = new UserTypeOptionValue($row['ID']);
                        $i++;
                    }
                }
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","FullName","NationalityID","DOB","PlaceOfBirth","Username","Password","UserTypeID","IsAccepted");
        $values = array($obj->ID, $obj->fullName, $obj->nationalityID, $obj->DOB, $obj->placeOfBirth, $obj->username, $obj->password, $obj->userTypeID, $obj->isAccepted);
        $db = Database::getInstance();
        $db->insert("user", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","FullName","NationalityID","DOB","PlaceOfBirth","Username","Password","UserTypeID","IsAccepted","LastUpdated");
        $values = array($obj->ID, $obj->fullName, $obj->nationalityID, $obj->DOB, $obj->placeOfBirth, $obj->username, $obj->password, $obj->userTypeID, $obj->isAccepted, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("user", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("user", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("user", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new User($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public static function logIn($username , $password){
        $db = Database::getInstance();
        $result = $db->selectWhere("user", "Username = '".$username."' and Password = '".sha1($password)."'");

        if($result != NULL){
            $row = mysqli_fetch_array($result);
            $userType = new Type($row['UserTypeID']);
            $user = UserFactory::getUser($userType->name , $row['ID']);
            
            return $user;
        }
        else{
            return NULL;
        }
    }

    public function refresh($Notification, $User){
        $UserID = $User->ID;
        $NotificationID = $Notification;

        $db = Database::getInstance();
        $result = $db->selectWhere("student", "UserID=".$UserID);

        if($result != NULL)
        {
            $row = mysqli_fetch_array($result);

            $result2 = $db->selectWhere("notifications", "ID=".$NotificationID);

            if($result2 != NULL)
            {
                $row2 = mysqli_fetch_array($result2);

                $Send_Mail = Facade::Send_Mail($row["MailAddress"], $row2["Title"], $row2["Content"]);
            }
        }
    }
}

?>