<?php
class Doctor extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Medicine(){
        $Viewer = new MedicineViewer();
        $Controller = new MedicineController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}