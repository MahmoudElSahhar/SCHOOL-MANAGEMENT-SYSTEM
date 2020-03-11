<?php
class UserFactory{

    public static function getUser($userType , $ID){
        $db = Database::getInstance();

        if($userType == 'Student'){
            $result = $db->selectWhere("student", "UserID = '".$ID."'");
            $row = mysqli_fetch_array($result);
            return (new Student($row['ID']));
        }
        else {
            $result = $db->selectWhere("employee", "UserID = '".$ID."'");
            $row = mysqli_fetch_array($result);

            if($userType == 'Student Affairs'){
                return (new StudentAffairs($row['ID']));
            }
            else if($userType == 'Admin'){
                return (new Admin($row['ID']));
            }
            else if($userType == 'Accountant'){
                return (new Accountant($row['ID']));
            }
            else if($userType == 'Doctor'){
                return (new Doctor($row['ID']));
            }
            else if($userType == 'Employee Affairs'){
                return (new EmployeeAffairs($row['ID']));
            }
            else if($userType == 'Storekeeper'){
                return (new StoreKeeper($row['ID']));
            }
            else if($userType == 'Teacher'){
                return (new Teacher($row['ID']));
            }
        }
    }
}

?>