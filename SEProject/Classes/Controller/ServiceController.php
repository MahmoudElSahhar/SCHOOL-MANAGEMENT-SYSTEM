<?php

class ServiceController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $service = $this->Facade->Service->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewService'])){
            header("Location: Service.php");
        }

        if($service)
        {
            for($i=0;$i<sizeof($service);$i++)
            {
                if(isset($_POST['e_'.$service[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$service[$i]->ID]))
                {
                    $this->delete($service[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->Service->value = $_POST['Value'];
        $this->Facade->Service->date = $_POST['Date'];
        $this->Facade->Service->sourceTypeID = $_POST['SourceTypeID'];
        $this->Facade->Service->add($this->Facade->Service);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Service->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>