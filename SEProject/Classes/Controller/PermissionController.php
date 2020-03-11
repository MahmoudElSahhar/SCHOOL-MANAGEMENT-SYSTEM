<?php

class PermissionController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $db = Database::getInstance();
        $result = $db->selectWhere("permission", 1);

        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreatePermission'])){
            header("Location: Permission.php");
        }

        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                if(isset($_POST['e_'.$row['ID']]))
                {

                }

                if(isset($_POST['d_'.$row['ID']]))
                {
                    $this->delete($row['ID']);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $fields = array("UserTypeID","LinkID");
        $values = array($_POST['userTypeID'], $_POST['linkID']);
        $db = Database::getInstance();
        $db->insert("permission", $fields, $values);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $db = Database::getInstance();
        $db->delete("permission", "ID =".$ID);
    }

    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>