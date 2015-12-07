
<ul class="nav nav-pills">
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="add_cash.php">Add Cash</a></li>
    <li><a href="logout.php"><strong>Log Out</strong></a></li>
</ul>

<h3><?php print("Cash is {$user[0]['cash']}!"); ?></h3>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody>  
<?php
      foreach ($positions as $position)
   {
   print("<tr>");
   print("<td>{$position["symbol"]}<td>");
   print("<td>{$position["name"]}<td>");
   print("<td>{$position["shares"]}<td>");
   print("<td>{$position["price"]}<td>");
   print("<td>{$position["value"]}<td>");
   print("</tr>");
   }
?>
        </tbody>  
</table>

