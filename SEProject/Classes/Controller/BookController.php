<?php

class BookController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->Book->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewBook'])){
            header("Location: Book.php");
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
        $this->Facade->Book->authorName = $this->test_input($_POST['authorName']);
        $this->Facade->Book->edition = $this->test_input($_POST['edition']);
        $this->Facade->Book->productID = $_POST['productID'];
        $this->Facade->Book->add($this->Facade->Book);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Book->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>