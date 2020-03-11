<?php
class Day{
    public $ID;
    public $name;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("day", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($d){
        $fields = array("ID","Name");
        $values = array($d->ID, $d->name);
        $db = Database::getInstance();
        $db->insert("day", $fields, $values);
    }

    public static function update($d){
        $fields = array("ID","Name","LastUpdated");
        $values = array($d->ID, $d->name, $d->lastUpdated);
        $db = Database::getInstance();
        $db->update("day", $fields, $values);
    }

    public static function delete($dID){
        $db = Database::getInstance();
        $db->delete("day", "ID =".$dID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("day", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Day($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>