<?php
class Accountant extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Fees(){
        $Viewer = new FeesViewer();
        $Controller = new FeesController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Orders(){
        $Viewer = new OrdersViewer();
        $Controller = new OrdersController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Service(){
        $Viewer = new ServiceViewer();
        $Controller = new ServiceController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_PaidSalary(){
        $Viewer = new PaidSalaryViewer();
        $Controller = new PaidSalaryController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}