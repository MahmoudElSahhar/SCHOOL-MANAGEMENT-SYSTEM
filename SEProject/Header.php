<?php
session_start();
include "DatabaseFile/Database.php";
include "Classes/Facade.php";
?>

<link rel = "StyleSheet" href = "CSS/Style.css">
<link rel = "StyleSheet" href = "../CSS/Style.css">
<link rel = "StyleSheet" href = "../../CSS/Style.css">
<link rel = "StyleSheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "Anonymous">
<link rel = "StyleSheet" href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script type = "text/javascript" src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src = "https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src = "https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "Anonymous"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin = "Anonymous"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "Anonymous"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

<nav class = "navbar navbar-expand-lg">
    <div class = "navbar-brand">
        <img src = "https://i.ibb.co/Dz9mC6r/GLS-Logo.png" width = "70" height = "45">
        Gezira Language School
    </div>
    <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#navbarSupportedContent" aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
        <span class = "navbar-toggler-icon"></span>
    </button>

    <div class = "collapse navbar-collapse" id = "navbarSupportedContent">
        <ul class = "navbar-nav mr-auto">
            <li class = "nav-item border rounded active">
                <a class = "nav-link" href = "javascript:Home();">Home</a>
            </li>
            <li class = "nav-item border rounded ml-2">
                <a class = "nav-link" href = "">Admission</a>
            </li>
            <?php
            if(!empty($_SESSION["user"]))
            {
                echo '<li class = "nav-item border rounded ml-2">
                    <a class = "nav-link" href = "'.unserialize($_SESSION["user"])->links[0]->physicalAddress.'">Portal</a>
                </li>';
            }
            ?>
            <li class = "nav-item border rounded ml-2 dropdown">
                <a class = "nav-link dropdown-toggle" href = "" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
                    More
                </a>
                <div class = "dropdown-menu" aria-labelledby = "navbarDropdown">
                    <a class = "dropdown-item" href = "">Bus</a>
                    <div class = "dropdown-divider"></div>

                    <a class = "dropdown-item" href = "">Gallery</a>
                    <div class = "dropdown-divider"></div>

                    <a class = "dropdown-item" href = "">Calendar</a>
                    <div class = "dropdown-divider"></div>

                    <a class = "dropdown-item" href = "javascript:AboutUs();">About Us</a>
                    <div class = "dropdown-divider"></div>

                    <a class = "dropdown-item" href = "javascript:Chart();">Chart</a>
                </div>
            </li>
        </ul>

        <div id = "google_translate_element"></div>

        <ul class = "navbar-nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "">
                    <i class = "fa fa-facebook-square fa-2x" aria-hidden = "true"></i>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "">
                    <i class = "fa fa-instagram fa-2x" aria-hidden = "true"></i>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "">
                    <i class = "fa fa-google-plus-square fa-2x" aria-hidden = "true"></i>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "">
                    <i class = "fa fa-twitter-square fa-2x" aria-hidden = "true"></i>
                </a>
            </li>
            <?php
            if(!empty($_SESSION["user"]))
            {
                echo '<li class = "nav-item">
                    <a class = "nav-link" href = "javascript:Notification();">
                        <i class = "fa fa-bell fa-2x" aria-hidden = "true"></i>
                    </a>
                </li>';
            }
            ?>
            <li class = "nav-item">
                <form method = 'Post' action = 'Login_cont.php'>
                    <div class = "modal fade" id = "Login_Form_Modal" aria-hidden = "true">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                                <div class = "modal-header text-center">
                                    <h4 class = "w-100"><b>Sign in</b></h4>
                                    <button class = "close" data-dismiss = "modal">
                                        <i class = "fa fa-times" aria-hidden = "true"></i>
                                    </button>
                                </div>
                                <div class = "modal-body">
                                    <div class = "mb-4">
                                        <i class = "fa fa-envelope" aria-hidden = "true"></i>
                                        <input type = "text" id = "Modal_Email" class = "form-control validate" name = "username" required>
                                        <label data-error = "Please Enter A Valid E-mail" for = "Modal_Email">Your E-mail</label>
                                    </div>

                                    <div class = "mb-4">
                                        <i class = "fa fa-lock" aria-hidden = "true"></i>
                                        <input type = "Password" id = "Modal_Password" class = "form-control validate" name = "password" required>
                                        <label data-error = "Please Enter A Valid Password" for = "Modal_Password">Your Password</label>
                                    </div>
                                </div>
                                <div class = "modal-footer justify-content-center">
                                    <button type = "submit" id = "login" name = "login" class = "btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(empty($_SESSION["user"]))
                    {
                        echo '<a href = "" class = "nav-link" data-toggle = "modal" data-target = "#Login_Form_Modal">
                            <i class = "fa fa-user fa-2x" aria-hidden = "true"></i>
                        </a>';
                    }
                    else
                    {
                        echo "<a href = 'javascript:Logout();' class = 'nav-link'><i class = 'fa fa-sign-out fa-2x' aria-hidden = 'true'></i><div class = 'Nav_Bar_Full_Name h4'></div></a>";
                    }
                    ?>
                </form>
            </li>
        </ul>
    </div>
</nav>

<script>
    function Home()
    {
        window.location = "http://localhost/SEProject/index.php";
    }
    function AboutUs()
    {
        window.location = "http://localhost/SEProject/AboutUs.php";
    }
    function Chart()
    {
        window.location = "http://localhost/SEProject/chart.php";
    }
    function Logout()
    {
        window.location = "http://localhost/SEProject/Logout.php";
    }
    function Notification()
    {
        window.location = "http://localhost/SEProject/Notification.php";
    }
</script>

<script type = "text/javascript">
    function googleTranslateElementInit()
    {
        new google.translate.TranslateElement({pageLanguage: "en"}, "google_translate_element");
    }
</script>

<script>
    var input = document.getElementById("Modal_Email");
    input.addEventListener("keyup", function(event)
    {
        if(event.keyCode === 13)
        {
            event.preventDefault();
            document.getElementById("login").click();
        }
    });

    var input = document.getElementById("Modal_Password");
    input.addEventListener("keyup", function(event)
    {
        if(event.keyCode === 13)
        {
            event.preventDefault();
            document.getElementById("login").click();
        }
    });
</script>