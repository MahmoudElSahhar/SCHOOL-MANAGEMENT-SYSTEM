<?php

class UserTypeOptionValueViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
      $useroptionvalues = $this->Facade->UserTypeOptionValue->view(1);
      $usertypeoptions = $this->Facade->UserTypeOption->view(1);
      $user = $this->Facade->User->view(1);
      echo"
           <form method='post' action='' class = 'Form'>
                  <h3>UserTypeOptionID</h3>
                  <select class= 'form-control' name='userTypeOptionID' required>
                  <option value = ''>Choose One...</option>";
               for($i=0; $i<count($usertypeoptions); $i++)
              {
                echo "<option value='".$usertypeoptions[$i]->ID."'>".$usertypeoptions[$i]->ID."</option>";
              }
              echo"</select>
              <br>
              <h3>Value</h3>
              <input class = 'form-control' type='text' name='Value' placeholder = 'Value' required>
              <br>
              <h3>UserID</h3>
              <select class= 'form-control' name='UserID' required>
              <option value = ''>Choose One...</option>";
              for($i=0; $i<count($user); $i++)
             {
               echo "<option value='".$user[$i]->ID."'>".$user[$i]->ID."</option>";
             }
       
echo "  </select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $useroptionvalues = $this->Facade->UserTypeOptionValue->view(1);
      echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>UserTypeOptionID</th>
                    <th>Value</th>
                    <th>UserID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($useroptionvalues)
                    {
                        for($i = 0 ; $i < count($useroptionvalues) ; $i++)
                        {
                            echo"<tr>
                                <td>".$useroptionvalues[$i]->userTypeOptionID->ID."</td>
                                <td>".$useroptionvalues[$i]->value."</td>
                                <td>".$useroptionvalues[$i]->userID."</td>
                                <td><button type='submit' name='e_".$useroptionvalues[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$useroptionvalues[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewValue'>AddNewValue</button>
          </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }



}
?>