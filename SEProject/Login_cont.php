<?php
    session_start();
    include 'DatabaseFile/Database.php';
    include 'Classes/Facade.php';

    if(isset($_POST['login'])){
        $Facade = new Facade();
        $Validate = $Facade->User->logIn(test_input($_POST['username']), test_input($_POST['password']));
        
        if($Validate != NULL){
            $_SESSION['user'] = serialize($Validate);
            for($i = 0 ; $i < count($Validate)->links ; $i++)
            {
                echo "<a href = ".$Validate->links[$i]->physicalAddress." class = 'list-group-item list-group-item-action bg-light'>
                    ".$Validate->links[$i]->friendlyName."</a>";
            }
            header("Location: ".$Validate->links[0]->physicalAddress);
        }
        else{
            echo "<script> if(!alert('Wrong E-Mail Or Password!')) { document.location = 'index.php'; } </script>";
        }
    }

    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>