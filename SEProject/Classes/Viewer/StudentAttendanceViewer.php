<?php

class StudentAttendanceViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

  public function viewAddForm()
  {
     $lectures = $this->Facade->Lecture->view(1);
     $Attendance = $this->Facade->Attendance->view(1);
      echo"
           <form method='post' action='' class = 'Form'>
              <h3>LectureID</h3>
              <select class = 'form-control' name='LectureID' required>
              <option value = ''>Choose One...</option>";
                  for($i = 0 ; $i < count($lectures) ; $i++)
                  {
                     echo "<option value='".$lectures[$i]->ID."'>".$lectures[$i]->ID."</option>";
                  } 
      echo "  </select>
      <br>";
      echo"<h3>AttendanceID</h3>
      <select class = 'form-control' name='AttendanceID' required>
      <option value = ''>Choose One...</option>";
                  for($i = 0 ; $i < count($Attendance) ; $i++)
                  {
                       echo "<option value='".$Attendance[$i]->ID."'>".$Attendance[$i]->ID."</option>";
                  } 
      echo"<br><br>
      <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";           
        }

  public function viewInTable()
  {
      $StudentAttendance = $this->Facade->StudentAttendance->view(1);
      echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>LectureID</th>
                    <th>AttendanceID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($StudentAttendance)
                    {
                        for($i = 0 ; $i < count($StudentAttendance) ; $i++)
                        {
                            echo"<tr>
                                <td>".$StudentAttendance[$i]->lectureID."</td>
                                <td>".$StudentAttendance[$i]->attendanceID."</td>
                                <td><button type='submit' name='e_".$StudentAttendance[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$StudentAttendance[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                </tr>";

                        }
                    }
          echo "</tbody>
          </table>
          <br>
          <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAttendance'>AddNewAttenance</button>
      </form>
  ";
  echo "<script>
                $('#tbl').DataTable();
            </script>";
  }



}
?>