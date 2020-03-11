<?php

class StudentController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $student = $this->Facade->Student->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewStudent'])){
            header("Location: Student.php");
        }

        if($student)
        {
            for($i=0;$i<sizeof($student);$i++)
            {
                if(isset($_POST['e_'.$student[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$student[$i]->ID]))
                {
                    $this->delete($student[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->User->fullName = $this->test_input($_POST['FullName']);
        $this->Facade->User->nationalityID = $_POST['NationalityID'];
        $this->Facade->User->DOB = $_POST['DOB'];
        $this->Facade->User->placeOfBirth = $_POST['PlaceOfBirth'];
        $this->Facade->User->username = $this->test_input($_POST['UserName']);
        $this->Facade->User->password = sha1(test_input($_POST['Password']));
        $this->Facade->User->userTypeID = $_POST['UserTypeID'];
        $this->Facade->User->add($this->Facade->User);
        
        $condition1 = "Name='Student'";
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
        $Database = Database::getInstance();
        $lastIDuserObj = $Database->Last_ID();

        $this->Facade->UserTypeOptionValue->userID = $lastIDuserObj;
        $this->Facade->UserTypeOptionValue->add($this->Facade->UserTypeOptionValue);
        
        $this->Facade->Student->classID = $_POST['ClassID'];
        $this->Facade->Student->mailAddress = $_POST['Mail'];
        $this->Facade->Student->userID = $lastIDuserObj;
        $this->Facade->Student->add($this->Facade->Student);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Student->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>