<?php
class StudentViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm()
    {
        $getTypeID = $this->Facade->Type->view("Name='Nationality'");
        $Nationality = $this->Facade->Type->view("RefID=".$getTypeID[0]->ID);
        $classs = $this->Facade->Class->view(1);
        
        $condition1 = "Name='Student'";
        $TYPES = $this->Facade->Type->view($condition1);

        $condition2 = "UserTypeID=".$TYPES[0]->ID;
        $optiontypes = $this->Facade->UserTypeOption->view($condition2);

        foreach ($optiontypes as $x)
        {
            $condition="ID=".$x->optionID->ID;
            $options=Options::view($condition);
            foreach ($options as $z)
            {
                $condition="ID=".$z->inputType->ID;
                $input=Type::view($condition);
                echo"<form method='post' action='' class = 'Form'>";
                echo"<h3>".$z->name."</h3>";
                echo"<input class ='form-control' type='".$input[0]->name."' name='".$z->name. "' required>
                <br>";
            }  
        }

        echo "<h3>Class</h3>
                <select class= 'form-control' name='ClassID'>
                <option value = ''>Choose One...</option>";
                for($i=0; $i<count($classs); $i++)
                {
                    echo "<option value='".$classs[$i]->ID."'>".$classs[$i]->name."</option>";
                }
                echo"</select>
                <br>
                <h3>E-Mail</h3>  
                <input class = 'form-control' type='email' name='Mail' required>
                <br>
                <h3>FullName</h3>
                <input class = 'form-control' type='text' name='FullName' required>
                <br>
                <h3>NationalityID</h3>
                <select class= 'form-control' name='NationalityID'>
                <option value = ''>Choose One...</option>";
                for($i=0; $i<count($Nationality); $i++)
                {
                    echo "<option value='".$Nationality[$i]->ID."'>".$Nationality[$i]->name."</option>";
                }
                echo"</select>
                <br>
                <h3>DOB</h3>
                <input class = 'form-control' type='date' min = '1960-01-01' name='DOB' required>
                ";
                echo"<br>
                <h3>Place Of Birth</h3>
                <select class= 'form-control' name='PlaceOfBirth'>
                <option value = ''>Choose One...</option>";
                for($i=0; $i<count($Nationality); $i++)
                {
                    echo "<option value='".$Nationality[$i]->ID."'>".$Nationality[$i]->name."</option>";
                }
                echo"</select>
                <br>
                <h3>UserName</h3>
                <input class = 'form-control' type='text' name='UserName' required>
                <br>
                <h3>Password</h3>
                <input class = 'form-control' type='password' name='Password' required>
                <br>
                <h3>UserType</h3>
                <select class= 'form-control' name='UserTypeID'>
                <option value = ''>Choose One...</option>";
                for($i=0; $i<count($TYPES); $i++)
                {
                    echo "<option value='".$TYPES[$i]->ID."'>".$TYPES[$i]->name."</option>";
                }
                echo"</select>
                    <br><br>
                    <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>";
                
                echo "</form>";  

    }

  public function viewInTable(){
    $student = $this->Facade->Student->view(1);
    echo "
        <form method='post' action=''>
            <table id = 'tbl' class = 'table table-striped table-light'>
            <thead>
            <tr>
                <th>Class</th>
                <th>Mail Address</th>
                <th>UserID</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                if($student)
                {
                    for($i = 0 ; $i < count($student) ; $i++){
                        echo "<tr>
                            <td>".$student[$i]->classID."</td>
                            <td>".$student[$i]->mailAddress."</td>
                            <td>".$student[$i]->userID."</td>
                            <td><button type='submit' name='e_".$student[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                            <td><button type='submit' name='d_".$student[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                        </tr>";
                    }
                }
            echo "</tbody>
            </table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewStudent'>Add New Student</button>

        </form>
    ";
    echo "<script>
                $('#tbl').DataTable();
            </script>";
}



}
?>