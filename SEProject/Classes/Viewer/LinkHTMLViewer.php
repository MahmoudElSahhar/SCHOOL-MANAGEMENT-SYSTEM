<?php

class LinkHTMLViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $link = $this->Facade->Link->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Link</h3>
                <select class = 'form-control' name='linkID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($link) ; $i++){
                        echo "<option value='".$link[$i]->ID."'>".$link[$i]->friendlyName."</option>";
                    }
        echo "  </select>
                <br>
                <h3>HTML</h3>
                <textarea class = 'form-control' name='HTML' placeholder = 'HTML' required></textarea>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->LinkHTML->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Link</th>
                    <th>HTML</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->linkID->friendlyName."</td>
                                <td>".$AY[$i]->html."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewLinkHTML'>Create Link HTML</button>
            </form>
        ";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>