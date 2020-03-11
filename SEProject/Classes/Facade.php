<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(file_exists("../../PHPMailer/src/Exception.php"))
{
    require "../../PHPMailer/src/Exception.php";
    require "../../PHPMailer/src/PHPMailer.php";
    require "../../PHPMailer/src/SMTP.php";
}

include "iReport.php";
include "ReportGenerator.php";
include "AcademicYear.php";
include "Address.php";
include "Assignment.php";
include "AssignmentGrade.php";
include "Attendance.php";
include "Product.php";
include "Book.php";
include "Borrowing.php";
include "Bouns.php";
include "Class.php";
include "Day.php";
include "iObserver.php";
include "iOrder.php";
include "User.php";
include "Employee.php";
include "Admin.php";
include "Accountant.php";
include "Doctor.php";
include "EmployeeAffairs.php";
include "EmployeeAttendance.php";
include "Schedule.php";
include "ExamSchedule.php";
include "Fees.php";
include "GradeDetails.php";
include "GradeTypeValue.php";
include "Lecture.php";
include "LectureSchedule.php";
include "Link.php";
include "LinkHTML.php";
include "Medicine.php";
include "Note.php";
include "iSubject.php";
include "Notification.php";
include "Options.php";
include "OrderDetails.php";
include "Orders.php";
include "PaidSalary.php";
include "Registration.php";
include "Service.php";
include "StoreKeeper.php";
include "Student.php";
include "StudentAffairs.php";
include "StudentAttendance.php";
include "Subject.php";
include "Teacher.php";
include "Type.php";
include "UserAddress.php";
include "UserFactory.php";
include "UserTelephone.php";
include "UserTypeOption.php";
include "UserTypeOptionValue.php";
include "Log.php";

class Facade
{
    public $AcademicYear;
    public $Accountant;
    public $Address;
    public $Admin;
    public $Assignment;
    public $AssignmentGrade;
    public $Attendance;
    public $Product;
    public $Book;
    public $Borrowing;
    public $Bouns;
    public $Class;
    public $Day;
    public $Doctor;
    public $User;
    public $Employee;
    public $EmployeeAffairs;
    public $EmployeeAttendance;
    public $Schedule;
    public $ExamSchedule;
    public $Fees;
    public $GradeDetails;
    public $GradeTypeValue;
    public $Lecture;
    public $LectureSchedule;
    public $Link;
    public $LinkHTML;
    public $Medicine;
    public $Note;
    public $Notification;
    public $Options;
    public $OrderDetails;
    public $Orders;
    public $PaidSalary;
    public $Registration;
    public $Service;
    public $Student;
    public $StudentAffairs;
    public $StudentAttendance;
    public $StoreKeeper;
    public $Subject;
    public $Teacher;
    public $Type;
    public $UserAddress;
    public $UserFactory;
    public $UserTelephone;
    public $UserTypeOption;
    public $UserTypeOptionValue;
    public $Log;
    
    public function __construct()
    {
        $this->AcademicYear = new AcademicYear(0);
        $this->Accountant = new Accountant(0);
        $this->Address = new Address(0);
        $this->Admin = new Admin(0);
        $this->Assignment = new Assignment(0);
        $this->AssignmentGrade = new AssignmentGrade(0);
        $this->Attendance = new Attendance(0);
        $this->Product = new Product(0);
        $this->Book = new Book(0);
        $this->Borrowing = new Borrowing(0);
        $this->Bouns = new Bouns(0);
        $this->Class = new Classes(0);
        $this->Day = new Day(0);
        $this->Doctor = new Doctor(0);
        $this->User = new User(0);
        $this->Employee = new Employee(0);
        $this->EmployeeAffairs = new EmployeeAffairs(0);
        $this->EmployeeAttendance = new EmployeeAttendance(0);
        $this->Schedule = new Schedule(0);
        $this->ExamSchedule = new ExamSchedule(0);
        $this->Fees = new Fees(0);
        $this->GradeDetails = new GradeDetails(0);
        $this->GradeTypeValue = new GradeTypeValue(0);
        $this->Lecture = new Lecture(0);
        $this->LectureSchedule = new LectureSchedule(0);
        $this->Link = new Link(0);
        $this->LinkHTML = new LinkHTML(0);
        $this->Medicine = new Medicine(0);
        $this->Note = new Note(0);
        $this->Notification = new Notification(0);
        $this->Options = new Options(0);
        $this->OrderDetails = new OrderDetails(0);
        $this->Orders = new Orders(0);
        $this->PaidSalary = new PaidSalary(0);
        $this->Registration = new Registration(0);
        $this->Service = new Service(0);
        $this->Student = new Student(0);
        $this->StoreKeeper = new StoreKeeper(0);
        $this->StudentAffairs = new StudentAffairs(0);
        $this->StudentAttendance = new StudentAttendance(0);
        $this->Subject = new Subject(0);
        $this->Teacher = new Teacher(0);
        $this->Type = new Type(0);
        $this->UserAddress = new UserAddress(0);
        $this->UserFactory = new UserFactory(0);
        $this->UserTelephone = new UserTelephone(0);
        $this->UserTypeOption = new UserTypeOption(0);
        $this->UserTypeOptionValue = new UserTypeOptionValue(0);
        $this->Log = new Log(0);
    }

    public function Send_Mail($Email, $Title, $Content)
    {
        $mail = new PHPMailer(true);
        
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "BasselEmad247@gmail.com";
        $mail->Password = "Dragonsoul24";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        
        $mail->setFrom("BasselEmad247@gmail.com", "Al-Gezira Language School");
        $mail->addAddress($Email);
        
        $mail->isHTML(true);
        $mail->Subject = $Title;
        $mail->Body = $Content;
        
        $mail->send();
    }
}
?>