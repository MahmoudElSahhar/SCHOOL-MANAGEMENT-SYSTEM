<?php

class BorrowingController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->Borrowing->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewBorrowing'])){
            header("Location: Borrowing.php");
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
        $this->Facade->Borrowing->studentID = $_POST['studentID'];
        $this->Facade->Borrowing->bookID = $_POST['bookID'];
        $this->Facade->Borrowing->borrowDate = $_POST['borrowDate'];
        $this->Facade->Borrowing->returnDate = $_POST['returnDate'];
        $this->Facade->Borrowing->add($this->Facade->Borrowing);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Borrowing->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>