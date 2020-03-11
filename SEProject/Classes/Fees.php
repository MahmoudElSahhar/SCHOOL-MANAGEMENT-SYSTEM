<?php
class Fees{
    public $ID;
    public $value;
    public $registrationID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("fees", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->value = $row['Value'];
                $this->registrationID = new Registration($row['RegistrationID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($f){
        $fields = array("ID","Value","RegistrationID");
        $values = array($f->ID, $f->value, $f->registrationID);
        $db = Database::getInstance();
        $db->insert("fees", $fields, $values);
    }

    public static function update($f){
        $fields = array("ID","Value","RegistrationID","LastUpdated");
        $values = array($f->ID, $f->value, $f->registrationID, $f->lastUpdated);
        $db = Database::getInstance();
        $db->update("fees", $fields, $values);
    }

    public static function delete($fID){
        $db = Database::getInstance();
        $db->delete("fees", "ID =".$fID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("fees", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Fees($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>