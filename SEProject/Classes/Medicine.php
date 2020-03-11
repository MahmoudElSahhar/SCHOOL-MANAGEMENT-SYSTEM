<?php
class Medicine extends Product{
    public $ID;
    public $expiryDate;
    public $productID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("medicine", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);

                parent::__construct($row['ProductID']);


                $this->ID = $row['ID'];
                $this->expiryDate = $row['ExpiryDate'];
                $this->productID = $row['ProductID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($m){
        $fields = array("ID","ExpiryDate","ProductID");
        $values = array($m->ID, $m->expiryDate, $m->productID);
        $db = Database::getInstance();
        $db->insert("medicine", $fields, $values);
    }

    public static function update($m){
        $fields = array("ID","ExpiryDate","ProductID","LastUpdated");
        $values = array($m->ID, $m->expiryDate, $m->productID, $m->lastUpdated);
        $db = Database::getInstance();
        $db->update("medicine", $fields, $values);
    }

    public static function delete($mID){
        $db = Database::getInstance();
        $db->delete("medicine", "ID =".$mID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("medicine", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Medicine($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>