<?php
class Service{
    public $ID;
    public $value;
    public $date;
    public $sourceTypeID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("service", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->value = $row['Value'];
                $this->date = $row['Date'];
                $this->sourceTypeID = new Type($row['SourceTypeID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","Value","Date","SourceTypeID");
        $values = array($obj->ID, $obj->value, $obj->date, $obj->sourceTypeID);
        $db = Database::getInstance();
        $db->insert("service", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Value","Date","SourceTypeID","LastUpdated");
        $values = array($obj->ID, $obj->value, $obj->date, $obj->sourceTypeID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("service", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("service", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("service", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Service($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>