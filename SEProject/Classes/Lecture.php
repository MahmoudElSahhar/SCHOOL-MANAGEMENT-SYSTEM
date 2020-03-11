<?php
class Lecture{
    public $ID;
    public $name;
    public $startTime;
    public $endTime;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("lecture", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->startTime = $row['StartTime'];
                $this->endTime = $row['EndTime'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($l){
        $fields = array("ID","Name","StartTime","EndTime");
        $values = array($l->ID, $l->name, $l->startTime, $l->endTime);
        $db = Database::getInstance();
        $db->insert("lecture", $fields, $values);
    }

    public static function update($l){
        $fields = array("ID","Name","StartTime","EndTime","LastUpdated");
        $values = array($l->ID, $l->name, $l->startTime, $l->endTime, $l->lastUpdated);
        $db = Database::getInstance();
        $db->update("lecture", $fields, $values);
    }

    public static function delete($lID){
        $db = Database::getInstance();
        $db->delete("lecture", "ID =".$lID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("lecture", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Lecture($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>