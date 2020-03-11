<?php
class Teacher extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Assignment(){
        $Viewer = new AssignmentViewer();
        $Controller = new AssignmentController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_StudentAttendance(){
        $Viewer = new StudentAttendanceViewer();
        $Controller = new StudentAttendanceController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_AssignmentDetails(){
        $Viewer = new AssignmentGradeViewer();
        $Controller = new AssignmentGradeController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Notes(){
        $Viewer = new NoteViewer();
        $Controller = new NoteController();
        $Viewer->viewInTable();
        $Controller->check();
}

    public function CRUD_GradeDetails(){
        $Viewer = new GradeDetailsViewer();
        $Controller = new GradeDetailsController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_GradeTypeValue(){
        $Viewer = new GradeTypeValueViewer();
        $Controller = new GradeTypeValueController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}