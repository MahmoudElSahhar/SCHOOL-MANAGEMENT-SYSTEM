<?php

class PaidSalaryController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){
        $arr = $this->Facade->PaidSalary->view(1);

        if(isset($_POST['add'])){
            $this->add();
        }
    
        if(isset($_POST['AddNewPaidSalary'])){
            header("Location: PaidSalary.php");
        }
    
        if($arr)
        {
            for($i = 0 ; $i < count($arr) ; $i++){
                if(isset($_POST['e_'.$arr[$i]->ID])){
        
                }
                if(isset($_POST['d_'.$arr[$i]->ID])){
                    $this->delete($arr[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->PaidSalary->date = $_POST['date'];
        $this->Facade->PaidSalary->salary = $_POST['salary'];
        $this->Facade->PaidSalary->employeeID = $_POST['employee'];
        $this->Facade->PaidSalary->add($this->Facade->PaidSalary);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->PaidSalary->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>