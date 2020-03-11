<?php
class Product{
    public $ID;
    public $cost;
    public $name;
    public $quantity;
    public $productTypeID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("product", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->cost = $row['Cost'];
                $this->name = $row['Name'];
                $this->quantity = $row['Quantity'];
                $this->productTypeID = new Type($row['ProductTypeID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","Cost","Name","Quantity","ProductTypeID");
        $values = array($obj->ID, $obj->cost, $obj->name, $obj->quantity, $obj->productTypeID);
        $db = Database::getInstance();
        $db->insert("product", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Cost","Name","Quantity","ProductTypeID","LastUpdated");
        $values = array($obj->ID, $obj->cost, $obj->name, $obj->quantity, $obj->productTypeID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("product", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("product", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("product", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Product($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>