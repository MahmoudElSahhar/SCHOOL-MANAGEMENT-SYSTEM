<?php

class LinkController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->Link->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewLink'])){
            header("Location: Link.php");
        }

        if($AY)
        {
            for($i=0;$i<sizeof($AY);$i++)
            {
                if(isset($_POST['e_'.$AY[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$AY[$i]->ID]))
                {
                    $this->delete($AY[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Link->physicalAddress = $this->test_input($_POST['physicalAddress']);
        $this->Facade->Link->friendlyName = $this->test_input($_POST['friendlyName']);
        $this->Facade->Link->add($this->Facade->Link);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Link->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>