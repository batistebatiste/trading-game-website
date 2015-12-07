<?php

// configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        
        //error checking
         
        //check if symbol is valid
        if(lookup($_POST["symbol"])===false)
               apologize("Invalid stock symbol");
               
        // check if $_POST[shares] is a non negative integer
        if(preg_match("/^\d+$/", $_POST["shares"])!=true)
           {
             apologize("you did not enter a non negative integer for shares");
           }
         
        
       //remember for history 
       $transactiontype="buy";
       
       $equity=lookup($_POST["symbol"]);
       $tradecost=$_POST["shares"]*$equity["price"];
       //check if you don't spend more money than you have 
       $user = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
       if($user[0]["cash"]<$tradecost)
           {
             apologize("you do not have enough money");
           }
       //bank the trade 
       // -your cash account
        
        else 
        //mettre en majuscule le symbol  http://www.php.net/manual/fr/function.strtoupper.php
        $_POST["symbol"]=strtoupper($_POST["symbol"]);
        //insert the position into users portfolio
        query("INSERT INTO portfolio (id, symbol, shares) VALUES (?,?,?) ON DUPLICATE KEY UPDATE shares=shares+VALUES(shares)",$_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
        //update portfolio; add the cash
        query("UPDATE users SET cash=cash-? WHERE id=?",$tradecost,$_SESSION["id"]);
        
        //remember for history
        query("INSERT INTO history (id, transaction, symbol, shares, price, date) VALUES (?,?,?,?,?,?)", $_SESSION["id"], $transactiontype, $equity["symbol"], $_POST["shares"], $equity["price"], CURRENT_TIMESTAMP);
        
        //redirect (because you send no information) to portfolio
        redirect("/index.php");
    }
    
   else
    { 
        render("buy_form.php", ["title" => "Buy Form"]);
    }    
    
?>
