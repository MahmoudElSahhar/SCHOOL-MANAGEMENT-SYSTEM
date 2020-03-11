<?php

class TypeViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
      $Type = $this->Facade->Type->view(1);
      echo"
           <form method='post' action='' class = 'Form'>
                  <h3>Name</h3>
                  <input class = 'form-control' type='text' name='Name' placeholder = 'Name' required>
                  <br>
                <h3>RefID</h3>
                <select class= 'form-control' name='RefID' required>
                <option value = ''>Choose One...</option>";
               for($i=1; $i<count($Type); $i++)
              {
                echo "<option value='".$Type[$i]->ID."'>".$Type[$i]->refID->name."</option>";
              }
echo "  </select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $Type = $this->Facade->Type->view(1);
      echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>RefID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Type)
                    {
                        for($i = 1 ; $i < count($Type); $i++)
                        {
                            echo"<tr>
                                <td>".$Type[$i]->name."</td>
                                <td>".$Type[$i]->refID->name."</td>
                                <td><button type='submit' name='e_".$Type[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Type[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewType'>AddNewType</button>
          </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }
}
?>