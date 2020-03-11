<?php

class UserAddressViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
      $UserAddresses = $this->Facade->UserAddress->view(1);
      $Users = $this->Facade->User->view(1);
      $addresses = $this->Facade->Address->view(1);
      $contacts = $this->Facade->UserTelephone->view(1);
      echo"
           <form method='post' action='' class = 'Form'>
             <h3>UserID</h3>
             <select class= 'form-control' name='UserID' required>
             <option value = ''>Choose One...</option>";
               for($i=0; $i<count($Users); $i++)
              {
                echo "<option value='".$Users[$i]->ID."'>".$Users[$i]->ID."</option>";
              }
              echo"</select>
              <br>";

              echo "<h3>AddressID</h3>
              <select class= 'form-control' name='AddressID' required>
              <option value = ''>Choose One...</option>";
              for($i=0; $i<count($addresses); $i++)
             {
               echo "<option value='".$addresses[$i]->ID."'>".$addresses[$i]->ID."</option>";
             }
             echo"</select>
             <br>";
             echo "<h3>ContactTypeID</h3>
             <select class= 'form-control' name='ContactTypeID' required>
             <option value = ''>Choose One...</option>";
              for($i=0; $i<count($contacts); $i++)
             {
               echo "<option value='".$contacts[$i]->ID."'>".$contacts[$i]->ID."</option>";
             }

       
echo "  </select>
<br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $UserAddresses = $this->Facade->UserAddress->view(1);
      echo "
            <form  method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>UserID</th>
                    <th>AddressID</th>
                    <th>ContactTypeID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($UserAddresses)
                    {
                        for($i = 0 ; $i < count($UserAddresses) ; $i++)
                        {
                            echo"<tr>
                                <td>".$UserAddresses[$i]->userID."</td>
                                <td>".$UserAddresses[$i]->addressID->ID."</td>
                                <td>".$UserAddresses[$i]->contactTypeID->ID."</td>
                                <td><button type='submit' name='e_".$UserAddresses[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$UserAddresses[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewUserAddress'>AddNewUserAddress</button>
          </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }



}
?>