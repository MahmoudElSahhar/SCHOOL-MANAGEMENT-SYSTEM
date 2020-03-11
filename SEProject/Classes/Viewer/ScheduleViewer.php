<?php

class ScheduleViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Day = $this->Facade->Day->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>dayID</h3>
                <select class = 'form-control' name = 'dayID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Day) ; $i++)
                {
                    echo "<option value='".$Day[$i]->ID."'>".$Day[$i]->name."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Schedule = $this->Facade->Schedule->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>dayID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Schedule)
                    {
                        for($i = 0 ; $i < count($Schedule) ; $i++){
                            echo "<tr>
                                <td>".$Schedule[$i]->dayID."</td>
                                <td><button type='submit' name='e_".$Schedule[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Schedule[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateSchedule'>Create Schedule</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>