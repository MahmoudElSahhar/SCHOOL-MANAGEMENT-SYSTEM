<?php

class LectureViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        echo "  
            <form method='post' action='' class = 'Form'>
            <h3>Name</h3>
                <input class = 'form-control' type='text' name='name' placeholder = 'name' required>
                <br>
                <h3>Start Time</h3>
                <input class = 'form-control' type='time' min = '".date("H:i")."' name='startTime' required>
                <br>
                <h3>End Time</h3>
                <input class = 'form-control' type='time' min = '".date("H:i")."' name='endTime' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->Lecture->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->name."</td>
                                <td>".$AY[$i]->startTime."</td>
                                <td>".$AY[$i]->endTime."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewLecture'>Create Lecture</button>
            </form>
        ";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}
?>