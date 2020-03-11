<?php

class BorrowingViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $student = $this->Facade->Student->view(1);
        $book = $this->Facade->Book->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Student</h3>
                <select class = 'form-control' name='studentID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($student) ; $i++){
                        echo "<option value='".$student[$i]->ID."'>".$student[$i]->fullName."</option>";
                    }
        echo "  </select>
        <br>
        <h3>Book</h3>
                <select class = 'form-control' name='bookID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($book) ; $i++){
                        echo "<option value='".$book[$i]->ID."'>".$book[$i]->ID."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Borrow Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='borrowDate' required>
                <br>
                <h3>Return Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='returnDate' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $borrowing = $this->Facade->Borrowing->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>StudentID</th>
                    <th>BookID</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($borrowing)
                    {
                        for($i = 0 ; $i < count($borrowing) ; $i++){
                            echo "<tr>
                                <td>".$borrowing[$i]->studentID->fullName."</td>
                                <td>".$borrowing[$i]->bookID->ID."</td>
                                <td>".$borrowing[$i]->borrowDate."</td>
                                <td>".$borrowing[$i]->returnDate."</td>
                                <td><button type='submit' name='e_".$borrowing[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$borrowing[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewBorrowing'>Create Borrowing</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>