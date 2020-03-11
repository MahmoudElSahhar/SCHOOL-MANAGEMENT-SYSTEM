<?php
class Schedule{
    public $ID;
    public $dayID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("schedule", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->dayID = new Day($row['DayID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }

    }

    public static function add($obj){
        $fields = array("ID","DayID");
        $values = array($obj->ID, $obj->dayID);
        $db = Database::getInstance();
        $db->insert("schedule", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","DayID","LastUpdated");
        $values = array($obj->ID, $obj->dayID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("schedule", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("schedule", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("schedule", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Schedule($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>