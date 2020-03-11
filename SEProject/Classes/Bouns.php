<?php
class Bouns{
    public $ID;
    public $employeeID;
    public $percentage;
    public $year;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("bouns", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->employeeID = new Employee($row['EmployeeID']);
                $this->percentage = $row['Percentage'];
                $this->year = $row['Year'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($b){
        $fields = array("ID","EmployeeID","Percentage","Year");
        $values = array($b->ID, $b->employeeID, $b->percentage, $b->year);
        $db = Database::getInstance();
        $db->insert("bouns", $fields, $values);
    }

    public static function update($b){
        $fields = array("ID","EmployeeID","Percentage","Year","LastUpdated");
        $values = array($b->ID, $b->employeeID, $b->percentage, $b->year, $b->lastUpdated);
        $db = Database::getInstance();
        $db->update("bouns", $fields, $values);
    }

    public static function delete($bID){
        $db = Database::getInstance();
        $db->delete("bouns", "ID =".$bID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("bouns", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Bouns($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>