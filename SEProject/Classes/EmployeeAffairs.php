<?php
class EmployeeAffairs extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Bouns(){
        $Viewer = new BounsViewer();
        $Controller = new BounsController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_EmployeeAttendance(){
        $Viewer = new EmployeeAttendanceViewer();
        $Controller = new EmployeeAttendanceController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Employees(){
        $Viewer = new EmployeeViewer();
        $Controller = new EmployeeController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}

?>