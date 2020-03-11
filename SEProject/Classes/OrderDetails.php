<?php
class OrderDetails{
    public $ID;
    public $productID;
    public $quantity;
    public $orderID;
    public $totalCost;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("order_details", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->productID = new Product($row['ProductID']);
                $this->quantity = $row['Quantity'];
                $this->orderID = new Orders($row['OrderID']);
                $this->totalCost = $row['TotalCost'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","ProductID","Quantity","OrderID","TotalCost");
        $values = array($obj->ID, $obj->productID, $obj->quantity, $obj->orderID, $obj->totalCost);
        $db = Database::getInstance();
        $db->insert("order_details", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","ProductID","Quantity","OrderID","TotalCost","LastUpdated");
        $values = array($obj->ID, $obj->productID, $obj->quantity, $obj->orderID, $obj->totalCost, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("order_details", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("order_details", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("order_details", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new OrderDetails($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>