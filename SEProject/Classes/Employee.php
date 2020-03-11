<?php
class Employee extends User{
    public $ID;
    public $SSN;
    public $salary;
    public $socialStatusID;
    public $specialization;
    public $userID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("employee", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                parent::__construct($row['UserID']);

                $this->ID = $row['ID'];
                $this->SSN = $row['SSN'];
                $this->salary = $row['Salary'];
                $this->socialStatusID = new Type($row['SocialStatusID']);
                $this->specialization = $row['Specialization'];
                $this->userID = $row['UserID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","SSN","Salary","SocialStatusID","Specialization","UserID");
        $values = array($obj->ID, $obj->SSN, $obj->salary, $obj->socialStatusID, $obj->specialization, $obj->userID);
        $db = Database::getInstance();
        $db->insert("employee", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","SSN","Salary","SocialStatusID","Specialization","UserID","LastUpdated");
        $values = array($obj->ID, $obj->SSN, $obj->salary, $obj->socialStatusID, $obj->specialization, $obj->userID ,$obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("employee", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("employee", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("employee", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Employee($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>