<?php

class FeesViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Registration = $this->Facade->Registration->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>value</h3>
                <input class = 'form-control' type = 'Number' min = '0' max = '100000' name = 'value' placeholder = 'value' required>
                <br>
                <h3>registrationID</h3>
                <select class = 'form-control' name = 'registrationID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Registration) ; $i++)
                {
                    echo "<option value='".$Registration[$i]->ID."'>".$Registration[$i]->ID."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Fees = $this->Facade->Fees->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>value</th>
                    <th>registrationID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Fees)
                    {
                        for($i = 0 ; $i < count($Fees) ; $i++){
                            echo "<tr>
                                <td>".$Fees[$i]->value."</td>
                                <td>".$Fees[$i]->registrationID->ID."</td>
                                <td><button type='submit' name='e_".$Fees[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Fees[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateFees'>Create Fees</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){

        $Body = "<table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
        <tr>
        <th>Academic Year</th>
        <th>Paid</th>
        <th>Out Of</th>
        </tr>
        </thead><tbody>";

        $Registration = $this->Facade->Registration->view("StudentID=".unserialize($_SESSION["user"])->ID);

        if($Registration != NULL){
            for($i = 0; $i < count($Registration); $i++)
            {
                $Fees = $this->Facade->Fees->view("RegistrationID=".$Registration[$i]->ID);
                
                $AcademicYear = $this->Facade->AcademicYear->view("ID=".$Registration[$i]->academicYearID);

                $Type = $this->Facade->Type->view("ID=".$AcademicYear[0]->academicLevelID->ID);

                $Body = $Body."<tr>
                    <td>".$Type[0]->name."</td>
                    <td>".$Fees[0]->value."</td>
                    <td>".$AcademicYear[0]->fees."</td>
                </tr>";
            }
        }
        $Body = $Body."</tbody></table>";
        echo $Body;

        echo "<script>
                $('#tbl').DataTable();
            </script>";

        echo "
        <form method = 'Post' action = ''>
            <button class = 'btn btn-primary' type = 'Submit' name = 'PDF_Generator'>Download Fees Statement</button>
            <br>
        </form>";

        if(isset($_POST["PDF_Generator"]))
        {
           $pdf = new PDF_Generator($Body);
           ob_end_clean();
           $pdf->Generate();
        }
    }
}
?>