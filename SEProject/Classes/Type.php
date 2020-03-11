<?php
class Type implements iOrder{
    public $ID;
    public $name;
    public $refID;
    public $refObj;
    public $TempProductID;
    public $description;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("type", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];

                if($row['ID'] != $row['RefID']){
                    $this->refID = new Type($row['RefID']);
                }
            }
        }
    }

    public  function putOrderID($ID)
    {
        $this->refObj = new OrderDetails($ID);
        $this->TempProductID = new Product($this->refObj->productID->ID);
    }

    public function putTaxes()
    {
        $db = Database::getInstance();
        $res = $db->selectWhere("type","Name = 'Tax'");
        $row = mysqli_fetch_array($res);
        $result = $db->selectWhere("type","RefID =".$row['ID']);

        if($result != NULL)
        {
            $row = mysqli_fetch_array($result);

            $this->refObj->totalCost = $this->refObj->totalCost + intval($row['Name']);
            $this->description = $this->description.", With Taxes";
            return $this->refObj->totalCost;
        }
    }

    public function putDiscount()
    {
        $db = Database::getInstance();
        $res = $db->selectWhere("type","Name = 'Discount'");
        $row = mysqli_fetch_array($res);
        $result = $db->selectWhere("type","RefID =".$row['ID']);

        if($result != NULL)
        {
            $row = mysqli_fetch_array($result);
            $this->refObj->totalCost = $this->refObj->totalCost - intval($row['Name']);
            $this->description = $this->description.", With Discount";
            return $this->refObj->totalCost;
        }
    }
    
    public static function add($obj){
        $fields = array("ID","Name","RefID");
        $values = array($obj->ID, $obj->name, $obj->refID);
        $db = Database::getInstance();
        $db->insert("type", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Name","RefID","LastUpdated");
        $values = array($obj->ID, $obj->name, $obj->refID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("type", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("type", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();

        $result = $db->selectWhere("type", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Type($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>