<?php
class StoreKeeper extends Employee{
    
    public function __construct($ID){
        if($ID != 0){
            parent::__construct($ID);
            }
    }

    public function CRUD_Products(){
        $Viewer = new ProductViewer();
        $Controller = new ProductController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Books(){
        $Viewer = new BookViewer();
        $Controller = new BookController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_Borrowing(){
        $Viewer = new BorrowingViewer();
        $Controller = new BorrowingController();
        $Viewer->viewInTable();
        $Controller->check();
    }

    public function CRUD_OrderDetails(){
        $Viewer = new OrderDetailsViewer();
        $Controller = new OrderDetailsController();
        $Viewer->viewInTable();
        $Controller->check();
    }
}