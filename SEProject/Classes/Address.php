<?php
class Address{
    public $ID;
    public $addressName;
    public $refID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("address", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->addressName = $row['AddressName'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];

                if($row['ID'] != $row['RefID']){
                    $this->refID = new Address($row['RefID']);
                }
            }
        }
    }

    public static function add($a){
        $fields = array("ID","AddressName","RefID");
        $values = array($a->ID, $a->addressName, $a->refID);
        $db = Database::getInstance();
        $db->insert("address", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","AddressName","RefID","LastUpdated");
        $values = array($a->ID, $a->addressName, $a->refID, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("address", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("address", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("address", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Address($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>