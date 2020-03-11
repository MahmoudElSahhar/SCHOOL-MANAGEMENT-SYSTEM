<?php

class UserTelephonephoneViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
      $users = $this->Facade->User->view(1);
      $condition1 = "Name='Contact Type'";
      $TYPES = $this->Facade->Type->view($condition1);
      $condition2 = "RefID=".$TYPES[0]->ID;
      $TYPES2 = $this->Facade->Type->view($condition2);
      echo"
           <form method='post' action='' class = 'Form'>
              <h3>UserID</h3>
              <select class= 'form-control' name='UserID' required>
              <option value = ''>Choose One...</option>";
               for($i=0; $i<count($users); $i++)
              {
                echo "<option value='".$users[$i]->ID."'>".$users[$i]->ID."</option>";
              }
              echo"</select>
              <br>
              <h3>Telephone</h3>
              <input class= 'form-control' type='Number' min = '0' max = '999999999' name='Telephone' placeholder = 'Telephone' required>
              <br>";
              echo" <h3>ContactTypeID</h3>
              <select class= 'form-control' name='ContactTypeID' required>
              <option value = ''>Choose One...</option>";
              for($i=0; $i<count($TYPES2); $i++)
             {
               echo "<option value='".$TYPES2[$i]->ID."'>".$TYPES2[$i]->name."</option>";
             }
       
echo "  </select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $UserTelephone = $this->Facade->UserTelephone->view(1);
      echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>UserID</th>
                    <th>Telephone</th>
                    <th>ContactTypeID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($UserTelephone)
                    {
                        for($i = 0 ; $i < count($UserTelephone) ; $i++)
                        {
                            echo"<tr>
                                <td>".$UserTelephone[$i]->userID."</td>
                                <td>".$UserTelephone[$i]->telephone."</td>
                                <td>".$UserTelephone[$i]->contactTypeID->ID."</td>
                                <td><button type='submit' name='e_".$UserTelephone[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$UserTelephone[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewTelephone'>AddNewTelephone</button>
          </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }



}
?>