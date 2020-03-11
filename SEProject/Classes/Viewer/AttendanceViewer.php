<?php

class AttendanceViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $user = $this->Facade->User->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>User</h3>
                <select class = 'form-control' name='userID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($user) ; $i++){
                        echo "<option value='".$user[$i]->ID."'>".$user[$i]->ID."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='date' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->Attendance->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>UserID</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->userID."</td>
                                <td>".$AY[$i]->date."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAttendance'>Create Attendance</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>