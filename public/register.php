<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if(empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }     
        
        else if (empty($_POST["password"]))
        {
            apologize("you must provide a password");
        }
        
        else if (empty($_POST["confirmation"]))
        {
              apologize("you must provide a confirmation of your password");
        }
        
        else if ($_POST["password"]!=$_POST["confirmation"])
        {
           apologize("the confirmation does not match the password");
        }

       //To insert a new user into your database, you might want to call+check that username is unique
       // query returns false if INSERT faile 
        if(query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]))===false)
             {
               apologize("username duplicate");
             }
             
        else
        {     
        //if INSER succesful , find out which id was assigned to that user and remember that id in $_SESSION
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $_SESSION["id"] = $rows[0]["id"];
        //redirect to index.php
        redirect("index.php");
        }    
    }
    
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
