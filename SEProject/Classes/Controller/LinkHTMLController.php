<?php

class LinkHTMLController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->LinkHTML->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewLinkHTML'])){
            header("Location: LinkHTML.php");
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
        $this->Facade->LinkHTML->linkID = $_POST['linkID'];
        $this->Facade->LinkHTML->html = $this->test_input($_POST['HTML']);
        $this->Facade->LinkHTML->add($this->Facade->LinkHTML);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->LinkHTML->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>