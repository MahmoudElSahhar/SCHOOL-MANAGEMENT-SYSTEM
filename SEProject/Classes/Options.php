<?php
class Options{
    public $ID;
    public $name;
    public $dataType;
    public $inputType;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("options", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->dataType = new Type($row['DataTypeID']);
                $this->inputType = new Type($row['InputTypeID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","Name","DataTypeID","InputTypeID");
        $values = array($obj->ID, $obj->name, $obj->dataType, $obj->inputType);
        $db = Database::getInstance();
        $db->insert("options", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Name","DataTypeID","InputTypeID","LastUpdated");
        $values = array($obj->ID, $obj->name, $obj->dataType, $obj->inputType, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("options", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("options", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("options", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Options($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>