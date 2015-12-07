<?php

// configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        
        //remember for history 
       $transactiontype="sell";
        
        $stock=lookup($_POST["symbol"]);
        $price=$stock["price"];
        $shares=query("SELECT shares FROM portfolio WHERE id=? AND symbol=?", $_SESSION["id"], $_POST["symbol"]);
        $positionvalue=$price*$shares[0]["shares"];
        
        //update portfolio; add the cash
        query("UPDATE users SET cash=cash+? WHERE id=?", $positionvalue, $_SESSION["id"]);
      
        //delete the position from portfolio
        query("DELETE FROM portfolio WHERE id=? AND symbol=?", $_SESSION["id"], $_POST["symbol"]);
      
      
      //rememnber move for history
              query("INSERT INTO history (id, transaction, symbol, shares, price, date) VALUES (?,?,?,?,?,?)", $_SESSION["id"], $transactiontype, $stock["symbol"], $shares, $stock["price"], CURRENT_TIMESTAMP);
        //
        
        //redirect (because you send no information) to portfolio
        redirect("/index.php");
    }
    
   else
    {   
      
        $rows=query("SELECT * FROM portfolio WHERE id=?",$_SESSION["id"]);
        $equities=[];
        foreach($rows as $row)
        {
           $equities[]=$row["symbol"];
        }
        
        render("sell_form.php", ["title" => "Sell Form", "equities" => $equities]);
    }    
    
?>
