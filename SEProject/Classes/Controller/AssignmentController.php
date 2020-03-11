<?php

class AssignmentController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){
        $arr = $this->Facade->Assignment->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewAssignment'])){
            header("Location: Assignment.php");
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
        $this->Facade->Assignment->assignDate = $_POST['assignDate'];
        $this->Facade->Assignment->dueDate = $_POST['dueDate'];
        $this->Facade->Assignment->subjectID = $_POST['subjectID'];
        $this->Facade->Assignment->add($this->Facade->Assignment);
        
        $SubjectName = new Subject($_POST['subjectID']);

        $this->Facade->Notification->title = "New Assignment";
        $this->Facade->Notification->content = "Please note that you have a new assignment in ".$SubjectName->name.".";
        $this->Facade->Notification->date = $_POST['assignDate'];
        $this->Facade->Notification->senderID = unserialize($_SESSION["user"])->ID;

        $db = Database::getInstance();
        $result = $db->selectWhere("subject", "ID=".$_POST["subjectID"]);

        if($result != NULL)
        {
            $row = mysqli_fetch_array($result);
            $result2 = $db->selectWhere("class", "AcademicYearID=".$row["AcademicYearID"]);
            
            if($result2 != NULL)
            {
                
                while($row2 = mysqli_fetch_array($result2))
                {
                    $result3 = $db->selectWhere("student", "ClassID=".$row2["ID"]);
                    
                    if($result3 != NULL)
                    {
                        while($row3 = mysqli_fetch_array($result3))
                        {
                            $this->Facade->Notification->registerObserver(new User($row3["UserID"]));
                        }
                    }
                }
            }
        }
        $this->Facade->Notification->add($this->Facade->Notification);

        $ID = $db->Last_ID();
        $fields = array("NotificationID", "ReceiverID");
        
        for($i = 0; $i < count($this->Facade->Notification->observers); $i++)
        {
            $values = array($ID, $this->Facade->Notification->observers[$i]->ID);
            $db->insert("user_notifications", $fields, $values);
        }
        $this->Facade->Notification->notifyObservers($ID);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Assignment->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>