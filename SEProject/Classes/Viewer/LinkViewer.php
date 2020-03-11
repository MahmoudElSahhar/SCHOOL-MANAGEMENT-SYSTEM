<?php

class LinkViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
       
        echo "<form method='post' action='' class = 'Form'>
        <h3>Physical Address</h3>
                <input class = 'form-control' type='text' name='physicalAddress' placeholder = 'physicalAddress' required>
                <br>
                <h3>Friendly Name</h3>
                <input class = 'form-control' type='text' name='friendlyName' placeholder = 'friendlyName' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->Link->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Physical Address</th>
                    <th>Friendly Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->physicalAddress."</td>
                                <td>".$AY[$i]->friendlyName."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewLink'>Create Link</button>
            </form>
        ";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>