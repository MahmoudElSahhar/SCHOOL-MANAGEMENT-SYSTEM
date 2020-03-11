<?php
class UserTypeOptionValue{
    public $ID;
    public $userTypeOptionID;
    public $value;
    public $userID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("user_type_option_value", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->userTypeOptionID = new UserTypeOption($row['UserTypeOptionID']);
                $this->value = $row['Value'];
                $this->userID = $row['UserID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","UserTypeOptionID","Value","UserID");
        $values = array($obj->ID, $obj->userTypeOptionID, $obj->value, $obj->userID);
        $db = Database::getInstance();
        $db->insert("user_type_option_value", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","UserTypeOptionID","Value","UserID","LastUpdated");
        $values = array($obj->ID, $obj->userTypeOptionID, $obj->value, $obj->userID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("user_type_option_value", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("user_type_option_value", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("user_type_option_value", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new UserTypeOptionValue($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>