<?php
class PaidSalary{
    public $ID;
    public $employeeID;
    public $date;
    public $salary;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("paid_salary", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->employeeID = new Employee($row['EmployeeID']);
                $this->date = $row['Date'];
                $this->salary = $row['Salary'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","EmployeeID","Date","Salary");
        $values = array($obj->ID, $obj->employeeID, $obj->date, $obj->salary);
        $db = Database::getInstance();
        $db->insert("paid_salary", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","EmployeeID","Date","Salary","LastUpdated");
        $values = array($obj->ID, $obj->employeeID, $obj->date, $obj->salary ,$obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("paid_salary", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("paid_salary", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("paid_salary", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new PaidSalary($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>