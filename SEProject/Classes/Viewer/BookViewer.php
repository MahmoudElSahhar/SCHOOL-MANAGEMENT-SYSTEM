<?php

class BookViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $product = $this->Facade->Product->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Product</h3>
                <select class = 'form-control' name='productID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($product) ; $i++){
                        echo "<option value='".$product[$i]->ID."'>".$product[$i]->name."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Author Name</h3>
                <input class = 'form-control' type='text' name='authorName' placeholder = 'authorName' required>
                <br>
                <h3>Edition</h3>
                <input class = 'form-control' type='text' name='edition' placeholder = 'edition' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Book = $this->Facade->Book->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Author Name</th>
                    <th>Edition</th>
                    <th>Product</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Book)
                    {
                        for($i = 0 ; $i < count($Book) ; $i++){
                            echo "<tr>
                                <td>".$Book[$i]->authorName."</td>
                                <td>".$Book[$i]->edition."</td>
                                <td>".$Book[$i]->productID."</td>
                                <td><button type='submit' name='e_".$Book[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Book[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewBook'>Create Book</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>