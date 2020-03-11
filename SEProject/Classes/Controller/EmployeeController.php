<?php

class EmployeeController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Employee = $this->Facade->Employee->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateEmployee'])){
            header("Location: Employee.php");
        }

        if($Employee)
        {
            for($i=0;$i<sizeof($Employee);$i++)
            {
                if(isset($_POST['e_'.$Employee[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Employee[$i]->ID]))
                {
                    $this->delete($Employee[$i]->ID);
                    $this->Facade->User->delete($Employee[$i]->userID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->User->fullName = test_input($_POST['fullName']);
        $this->Facade->User->nationalityID = $_POST['nationalityID'];
        $this->Facade->User->DOB = $_POST['DOB'];
        $this->Facade->User->placeOfBirth = test_input($_POST['placeOfBirth']);
        $this->Facade->User->username = test_input($_POST['username']);
        $this->Facade->User->password = sha1(test_input($_POST['password']));
        $this->Facade->User->userTypeID = $_POST['userTypeID'];
        $this->Facade->User->isAccepted = $_POST['isAccepted'];
        $this->Facade->User->add($this->Facade->User);

        $Database = Database::getInstance();
        $ID = $Database->Last_ID();
        
        $this->Facade->Employee->SSN = $_POST['SSN'];
        $this->Facade->Employee->salary = $_POST['salary'];
        $this->Facade->Employee->socialStatusID = $_POST['socialStatusID'];
        $this->Facade->Employee->specialization = test_input($_POST['specialization']);
        $this->Facade->Employee->userID = $ID;
        $this->Facade->Employee->add($this->Facade->Employee);

        $condition1 = "Name='Employee'";
        $TYPES = $this->Facade->Type->view($condition1);

        $condition2 = "UserTypeID=".$TYPES[0]->ID;
        $optiontypes = $this->Facade->UserTypeOption->view($condition2);
        
        foreach($optiontypes as $x)
        {
            $this->Facade->UserTypeOptionValue->userTypeOptionID = $x->ID;
            $condition = "ID=".$x->optionID->ID;
            $options = $this->Facade->Options->view($condition);

            foreach($options as $z)
            {
                $this->Facade->UserTypeOptionValue->value = $_POST[''.$z->name];
            }
        }
        
        $this->Facade->UserTypeOptionValue->userID = $ID;
        $this->Facade->UserTypeOptionValue->add($this->Facade->UserTypeOptionValue);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Employee->delete($ID);
    }

    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>