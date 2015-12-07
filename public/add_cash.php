<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
    $addedcash=$_POST[cash];
    //il faut changer ce qu'il y'a dans "cash" de la table user 
    query("UPDATE users SET cash=cash+? WHERE id=?", $addedcash, $_SESSION["id"]);
    //redirect (because you send no information) to portfolio
        redirect("/index.php");
    
    }
    
    
     else
    {
        // else render form
        render("add_cash_form.php", ["title" => "Add Cash"]);
    }
    
    
    
    
?>
