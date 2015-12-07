<?php
    // configuration
    require("../includes/config.php"); 
    
$positions = [];
$values = query("SELECT symbol, shares FROM portfolio WHERE id = ?", $_SESSION["id"]);

foreach ($values as $value)
{
    $stock = lookup($value["symbol"]);
    if ($stock !== false)
    {
        $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $value["shares"],
            "symbol" => $value["symbol"],
            "value" => $stock["price"]*$value["shares"]
        ];
    }
}

//query cash and put it into template
$user = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

render("portfolio.php", ["positions" => $positions, "user"=> $user,"title" => "Portfolio"]);
?>

