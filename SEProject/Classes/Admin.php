<?php
class Admin extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Address(){
        $Viewer = new AddressViewer();
        $Controller = new AddressController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Type(){
        $Viewer = new TypeViewer();
        $Controller = new TypeController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_UserTypeOption(){
        $Viewer = new UserTypeOptionViewer();
        $Controller = new UserTypeOptionController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Day(){
        $Viewer = new DayViewer();
        $Controller = new DayController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Link(){
        $Viewer = new LinkViewer();
        $Controller = new LinkController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Lecture(){
        $Viewer = new LectureViewer();
        $Controller = new LectureController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_LinkHTML(){
        $Viewer = new LinkHTMLViewer();
        $Controller = new LinkHTMLController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Options(){
        $Viewer = new OptionsViewer();
        $Controller = new OptionsController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Employees(){
        $Viewer = new EmployeeViewer();
        $Controller = new EmployeeController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Permission(){
        $Viewer = new PermissionViewer();
        $Controller = new PermissionController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function View_Log(){
        $Viewer = new LogViewer();
        $Viewer->viewInTable();
    }
}