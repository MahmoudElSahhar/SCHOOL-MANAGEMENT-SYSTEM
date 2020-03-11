<?php
class UserTypeOption{
    public $ID;
    public $userTypeID;
    public $optionID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("user_type_option", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->userTypeID = new Type($row['UserTypeID']);
                $this->optionID = new Options($row['OptionID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","UserTypeID","OptionID");
        $values = array($obj->ID, $obj->userTypeID, $obj->optionID);
        $db = Database::getInstance();
        $db->insert("user_type_option", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","UserTypeID","OptionID","LastUpdated");
        $values = array($obj->ID, $obj->userTypeID, $obj->optionID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("user_type_option", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("user_type_option", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("user_type_option", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new UserTypeOption($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>