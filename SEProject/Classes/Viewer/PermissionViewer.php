<?php

class PermissionViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $db = Database::getInstance();
        $result = $db->selectWhere("type", "Name='UserType'");
        $row = mysqli_fetch_array($result);
        $result2 = $db->selectWhere("type", "RefID=".$row['ID']);

        $result3 = $db->selectWhere("link", 1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>UserType</h3>
                <select class = 'form-control' name = 'userTypeID' required>
                <option>Choose One...</option>";
                if($result2)
                {
                    while($row2 = mysqli_fetch_array($result2))
                    {
                        echo "<option value='".$row2['ID']."'>".$row2['Name']."</option>";
                    }
                }
        echo "
                </select>
                <br>
                <h3>Page</h3>
                <select class = 'form-control' name = 'linkID' required>
                <option>Choose One...</option>";
                if($result3)
                {
                    while($row3 = mysqli_fetch_array($result3))
                    {
                        echo "<option value='".$row3['ID']."'>".$row3['FriendlyName']."</option>";
                    }
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
    }

    public function viewInTable(){
        $db = Database::getInstance();
        $result = $db->selectWhere("permission", 1);

        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>UserType</th>
                    <th>Page</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead><tbody>";
                    if($result)
                    {
                        while($row = mysqli_fetch_array($result)){
                            $type = new Type($row['UserTypeID']);
                            $link = new Link($row['LinkID']);
                            echo "<tr>
                                <td>".$type->name."</td>
                                <td>".$link->friendlyName."</td>
                                <td><button type='submit' name='e_".$row['ID']."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$row['ID']."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreatePermission'>Create Permission</button>
                <br>
            </form>";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>