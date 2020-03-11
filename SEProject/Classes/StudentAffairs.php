<?php
class StudentAffairs extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_LectureSchedule(){
        $Viewer = new LectureScheduleViewer();
        $Controller = new LectureScheduleController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Registration(){
        $Viewer = new RegistrationViewer();
        $Controller = new RegistrationController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Students(){
        $Viewer = new StudentViewer();
        $Controller = new StudentController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Subject(){
        $Viewer = new SubjectViewer();
        $Controller = new SubjectController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_AcademicYear(){
        $Viewer = new AcademicYearViewer();
        $Controller = new AcademicYearController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Class(){
        $Viewer = new ClassViewer();
        $Controller = new ClassController();       
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_ExamSchedule(){
        $Viewer = new ExamScheduleViewer();
        $Controller = new ExamScheduleController();      
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_ClassSchedule(){
        $Viewer = new ClassScheduleViewer();
        $Controller = new ClassScheduleController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}

?>