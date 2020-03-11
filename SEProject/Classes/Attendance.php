<?php
class Attendance{
    public $ID;
    public $userID;
    public $date;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("attendance", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->userID = $row['UserID'];
                $this->date = $row['Date'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($a){
        $fields = array("ID","UserID","Date");
        $values = array($a->ID, $a->userID, $a->date);
        $db = Database::getInstance();
        $db->insert("attendance", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","UserID","Date","LastUpdated");
        $values = array($a->ID, $a->userID, $a->date, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("attendance", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("attendance", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("attendance", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Attendance($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>