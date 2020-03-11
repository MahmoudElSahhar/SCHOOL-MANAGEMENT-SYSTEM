<?php

class ServiceViewer
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
                <h3>Value</h3>
                <input class = 'form-control' type='number' min = '0' max = '1000000' step = 'Any'  name='Value' placeholder = 'Value' required>
                <br>
                <h3>Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='Date' required>
                <br>
                <h3>SourceTypeID</h3>
                <select class = 'form-control' name='SourceTypeID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Type) ; $i++)
                {
                    echo "<option value='".$Type[$i]->ID."'>".$Type[$i]->name."</option>";
                }
        echo "</select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
  }

  public function viewInTable()
  {
      $service = $this->Facade->Service->view(1);
      echo "
        <form method='post' action=''>
            <table id = 'tbl' class = 'table table-striped table-light'>
            <thead>
            <tr>
                <th>Value</th>
                <th>Date</th>
                <th>SourceTypeID</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                if($service)
                {
                    for($i = 0 ; $i < count($service) ; $i++)
                    {
                        echo"<tr>
                            <td>".$service[$i]->value."</td>
                            <td>".$service[$i]->date."</td>
                            <td>".$service[$i]->sourceTypeID->name."</td>
                            <td><button type='submit' name='e_".$service[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                            <td><button type='submit' name='d_".$service[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                    }
                }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewService'>Create Service</button>
      </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }



}
?>