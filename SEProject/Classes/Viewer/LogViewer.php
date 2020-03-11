<?php

class LogViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewInTable(){
        $Log = $this->Facade->Log->view(1);
        echo "
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>TableName</th>
                    <th>Action</th>
                    <th>creationDate</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Log)
                    {
                        for($i = 0 ; $i < count($Log) ; $i++){
                            echo "<tr>
                                <td>".$Log[$i]->TableName."</td>
                                <td>".$Log[$i]->Action."</td>
                                <td>".$Log[$i]->creationDate."</td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}
?>