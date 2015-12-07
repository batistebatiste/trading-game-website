<?php

// configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        $equity=[lookup($_POST["symbol"])]; //will return an associative array with 3 keyssymbol,name,price
        //if wrong stock symbol
        if($equity===false)               //$_POST is an associative array with name, symbol and price of the stock we want to look up
        {
            apologize("wrong stock symbol");
        }
        
        //if good stock symbol render quote_price.php
        render("quote_price.php",["equity"=> $equity, "title"=>"Quote"]); 
    }
    
else
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }    
    
?>
