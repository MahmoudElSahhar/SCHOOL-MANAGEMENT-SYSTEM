<?php
class Orders{
    public $ID;
    public $orderCost;
    public $requestDate;
    public $arrivalDate;
    public $received;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("orders", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->orderCost = $row['OrderCost'];
                $this->requestDate = $row['RequestDate'];
                $this->arrivalDate = $row['ArrivalDate'];
                $this->received = $row['Received'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","OrderCost","RequestDate","ArrivalDate","Received");
        $values = array($obj->ID, $obj->orderCost, $obj->requestDate, $obj->arrivalDate, $obj->received);
        $db = Database::getInstance();
        $db->insert("orders", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","OrderCost","RequestDate","ArrivalDate","Received","LastUpdated");
        $values = array($obj->ID, $obj->orderCost, $obj->requestDate, $obj->arrivalDate, $obj->received, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("orders", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("orders", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("orders", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Orders($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>