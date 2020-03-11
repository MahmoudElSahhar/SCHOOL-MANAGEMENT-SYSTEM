<?php

class UserTypeOptionViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
      $TypeOptions = $this->Facade->UserTypeOption->view(1);

      $condition1 = "Name='UserType'";
      $TYPES = $this->Facade->Type->view($condition1);

      $condition2 = "RefID=".$TYPES[0]->ID;
      $TYPES2 = $this->Facade->Type->view($condition2);

      $options = $this->Facade->Options->view(1);

      echo"
           <form method='post' action='' class = 'Form'>
                 <h3>UserTypeID</h3>
                 <select class= 'form-control' name='UserTypeID' required>
                 <option value = ''>Choose One...</option>";
                  for($i=0; $i<count($TYPES2); $i++)
                 {
                   echo "<option value='".$TYPES2[$i]->ID."'>".$TYPES2[$i]->name."</option>";
                 }
                 echo"</select> 
                 <br>
                 <h3>OptionID</h3>
                 <select class= 'form-control' name='OptionID' required>
                 <option value = ''>Choose One...</option>";
                  for($i=0; $i<count($TYPES2); $i++)
                 {
                   echo "<option value='".$options[$i]->ID."'>".$options[$i]->name."</option>";
                 }
echo "  </select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $TypeOptions = $this->Facade->UserTypeOption->view(1);
      echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>UserTypeID</th>
                    <th>OptionID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($TypeOptions)
                    {
                        for($i = 0 ; $i < count($TypeOptions) ; $i++)
                        {
                            echo"<tr>
                                <td>".$TypeOptions[$i]->userTypeID->name."</td>
                                <td>".$TypeOptions[$i]->optionID->name."</td>
                                <td><button type='submit' name='e_".$TypeOptions[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$TypeOptions[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewUserTypeOption'>NewTypeOption</button>
          </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }
}
?>