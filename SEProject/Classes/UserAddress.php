<?php
class UserAddress{
    public $ID;
    public $userID;
    public $addressID;
    public $contactTypeID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("user_address", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->userID = $row['UserID'];
                $this->addressID = new Address($row['AddressID']);
                $this->contactTypeID = new Type($row['ContactTypeID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","UserID","AddressID","ContactTypeID");
        $values = array($obj->ID, $obj->userID, $obj->addressID, $obj->contactTypeID);
        $db = Database::getInstance();
        $db->insert("user_address", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","UserID","AddressID","ContactTypeID","LastUpdated");
        $values = array($obj->ID, $obj->userID, $obj->addressID, $obj->contactTypeID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("user_address", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("user_address", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("user_address", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new UserAddress($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>