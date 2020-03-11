<?php

class EmployeeViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){

        $getTypeID = $this->Facade->Type->view("Name='Nationality'");
        $Nationality = $this->Facade->Type->view("RefID=".$getTypeID[0]->ID);

        $TYPES = $this->Facade->Type->view("Name='UserType'");
        $userTypes = $this->Facade->Type->view("RefID=".$TYPES[0]->ID);

        $social = $this->Facade->Type->view("Name='Social Status'");
        $socialStatus = $this->Facade->Type->view("RefID=".$social[0]->ID);

        $condition1 = "Name='Employee'";
        $type = $this->Facade->Type->view($condition1);

        $condition2 = "UserTypeID=".$type[0]->ID;
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
                echo"<input class ='form-control' type='".$input[0]->name."' name='".$z->name. "' placeholder = '".$z->name. "' required>
                <br>";
            }  
        }

        echo "
                <h3>fullName</h3>
                <input class = 'form-control' type = 'Text' name = 'fullName' placeholder = 'fullName' required>
                <br>
                <h3>nationalityID</h3>
                <select class = 'form-control' name = 'nationalityID' required>
                <option>Choose One...</option>";
                for($i = 0 ; $i < count($Nationality) ; $i++)
                {
                    echo "<option value='".$Nationality[$i]->ID."'>".$Nationality[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>DOB</h3>
                <input class = 'form-control' type = 'Date' name = 'DOB' placeholder = 'DOB' required>
                <br>
                <h3>placeOfBirth</h3>
                <input class = 'form-control' type = 'Text' name = 'placeOfBirth' placeholder = 'placeOfBirth' required>
                <br>
                <h3>username</h3>
                <input class = 'form-control' type = 'Text' name = 'username' placeholder = 'username' required>
                <br>
                <h3>password</h3>
                <input class = 'form-control' type = 'Password' name = 'password' placeholder = 'password' required>
                <br>
                <h3>userTypeID</h3>
                <select class = 'form-control' name = 'userTypeID' required>
                <option>Choose One...</option>";
                for($i = 0 ; $i < count($userTypes) ; $i++)
                {
                    echo "<option value='".$userTypes[$i]->ID."'>".$userTypes[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>isAccepted</h3>
                <select class = 'form-control' name = 'isAccepted' required>
                <option>Choose One...</option>
                <option value = '1'>Yes</option>
                <option value = '0'>No</option>
                </select>
                <br>
                <h3>SSN</h3>
                <input class = 'form-control' type = 'Number' name = 'SSN' placeholder = 'SSN' required>
                <br>
                <h3>salary</h3>
                <input class = 'form-control' type = 'Number' name = 'salary' placeholder = 'salary' required>
                <br>
                <h3>socialStatusID</h3>
                <select class = 'form-control' name = 'socialStatusID' required>
                <option>Choose One...</option>";
                for($i = 0 ; $i < count($socialStatus) ; $i++)
                {
                    echo "<option value='".$socialStatus[$i]->ID."'>".$socialStatus[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>specialization</h3>
                <textarea class = 'form-control' name = 'specialization' placeholder = 'specialization' required></textarea>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Employee = $this->Facade->Employee->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Full Name</th>
                    <th>salary</th>
                    <th>socialStatusID</th>
                    <th>specialization</th>
                    <th>userID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";
                    if($Employee)
                    {
                        for($i = 0 ; $i < count($Employee) ; $i++){
                            echo "<tr>
                                <td>".$Employee[$i]->fullName."</td>
                                <td>".$Employee[$i]->salary."</td>
                                <td>".$Employee[$i]->socialStatusID->name."</td>
                                <td>".$Employee[$i]->specialization."</td>
                                <td>".$Employee[$i]->userID."</td>
                                <td><button type='submit' name='e_".$Employee[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Employee[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateEmployee'>Create Employee</button>
            </form>";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>