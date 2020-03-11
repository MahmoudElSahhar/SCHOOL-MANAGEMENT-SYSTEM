<?php

class ClassViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $AY = $this->Facade->AcademicYear->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Academic Year</h3>
                <select class = 'form-control' name='academicYearID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($AY) ; $i++){
                        echo "<option value='".$AY[$i]->ID."'>".$AY[$i]->ID."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Name</h3>
                <input class = 'form-control' type='text' name='name' placeholder = 'name' required>
                <br>
                <h3>Capacity</h3>
                <input class = 'form-control' type='number' min = '0' max = '60' name='capacity' placeholder = 'capacity' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Class = $this->Facade->Class->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Academic Year</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>";
                    if($Class)
                    {
                        for($i = 0 ; $i < count($Class) ; $i++){
                            echo "<tr>
                                <td>".$Class[$i]->academicYearID."</td>
                                <td>".$Class[$i]->name."</td>
                                <td>".$Class[$i]->capacity."</td>
                                <td><button type='submit' name='e_".$Class[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Class[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewClass'>Create Class</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        $Class = $this->Facade->Class->view("ID=".unserialize($_SESSION["user"])->classID);
        echo "
        <table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
        <tr>
            <th>Academic Year</th>
            <th>Name</th>
            <th>Capacity</th>
            </tr>
            </thead>
            <tbody>";
            if($Class)
            {
                echo "<tr>
                    <td>".$Class[0]->academicYearID."</td>
                    <td>".$Class[0]->name."</td>
                    <td>".$Class[0]->capacity."</td>
                </tr>";
            }
        echo "
        </tbody>
        </table>";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}
?>