<table class="table table-striped">

    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
  
   <?php
      foreach ($history as $move)
   {
   print("<tr>");
   print("<td>{$move["transaction"]}<td>");
   print("<td>{$move["symbol"]}<td>");
   print("<td>{$move["shares"]}<td>");
   print("<td>{$move["price"]}<td>");
   print("</tr>");
   }
?>
   
  
    </tbody>

</table>
