<div id="headerbar">
    <h1><?php 
    echo 'Quotes Printed'; ?></h1>
    
</div>

        <?php 
     $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
     if($XML==null){
         $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
     }
        foreach($XML->Cube->Cube->Cube as $rate){ 
                    
      if($rate["currency"]=='USD'){
    $exchange = (string)$rate["rate"];
    $USDrate = floatval($exchange);
    break;
      }

  }  
  

/*


        1. MInimums kas katru meenesi ir jaaizpilda ir 3800 eur apgroziijums un liidz shim slieksnim paliek vienaadi % Easy standart Hard attieciigi 6 8 10

        2. Naakamais slieksnis ir 
 * 5200 eur, kuru sasniedzot automaatiski reekjinaas 7 9 11 %

        3 peedeejais slieksnis ir 6200 eur kur reekjinaas jau 8 10 11 %

           UN tad varbuut var ielikt 7500 kaa peedeejo slieksni 9 11 12%
           
           */
              $TURNOVER_EUR = 0;
                      foreach ($data as $group) {
                    foreach($group['USD'] as $quote_USD){ 
                         if (strpos($group['group_name'], 'Print') === false) {
                        $TURNOVER_EUR = $TURNOVER_EUR+ $quote_USD->quote_item_subtotal/$USDrate;
                        }
                    }
                       foreach($group['EUR'] as $quote_EUR){
                          if (strpos($group['group_name'], 'Print') === false) {
                           $TURNOVER_EUR = $TURNOVER_EUR+ $quote_EUR->quote_item_subtotal;
                           }
                    }
                      }
                      
                      $TURNOVER_EUR = round($TURNOVER_EUR,2);
  
  
  
        ?>
<div id="content" class="table-content">
    <p>
        <a href="<?php echo base_url(). 'users/view/'. $data[0]['user'][0]->user_id.'/P' ?>"> Previous Month </a>
    </p>
    <p>
        <a href="<?php echo base_url(). 'users/view/'. $data[0]['user'][0]->user_id.'/T' ?>"> This Month </a>
    </p>
    <p>
        Exchange Rate: <?php echo $USDrate ?>
        
    </p>
    <p>User: <?php 
    echo $data[0]['user'][0]->user_name;?> </p>
<p>From: <?php echo $data[0]['start'] ; ?></p>
    <p>To: <?php echo $data[0]['end'] ; ?></p>
    <p>Checked: <?php echo $data[0]['today'] ; ?></p>
    <p>Turnover: <?php echo $TURNOVER_EUR; ?> </p>
    <?php echo $this->layout->load_view('layout/alerts'); ?>

    <div class="table-responsive">
        <table class="table table-striped">

            <thead>
            <tr>
                <th><?php echo 'Quote number'; ?></th>
                <th><?php echo 'Date Printed'; ?></th>
                <th><?php echo 'Value'; ?></th>
                <th><?php echo 'Quote Group'; ?></th>
                <th><?php echo 'Salary'; ?></th>
            </tr>
            </thead>

            <tbody>
            <?php 
            $TOTAL_EUR = 0;

                      
                      $percentPrint = 0.02;
                      $percentHard = 0.1;
                      $percentStandard = 0.08;
                      $percentEasy = 0.06;
                      
                   
                      $CURRENT_TOTAL = 0;
                      $allQuotes = array();
                      
            foreach ($data as $group) {
                    foreach($group['USD'] as $quote_USD){ 
                   $item = array(
                       'group_name'=>$group['group_name'],
                       'quote'=>$quote_USD,
                       'print_date'=>$quote_USD->quote_date_printed
                   );     
                      array_push($allQuotes,$item);  
            }
            
              foreach($group['EUR'] as $quote_USD){ 
                   $item = array(
                       'group_name'=>$group['group_name'],
                       'quote'=>$quote_USD,
                       'print_date'=>$quote_USD->quote_date_printed
                   );     
                      array_push($allQuotes,$item);  
            }
                    }
            
            function compareOrder($a, $b)
{
  $ad = new DateTime($a['print_date']);
  $bd = new DateTime($b['print_date']);

  if ($ad == $bd) {
    return 0;
  }

  return $ad < $bd ? -1 : 1;
}
                
      
$result = usort($allQuotes, 'compareOrder');
            
            ?>
       <?php 

       foreach($allQuotes as $item){
           $quote_USD = $item['quote'];
           $groupName = $item['group_name'];
           
           $subtotal = $quote_USD->quote_item_subtotal;
           if($quote_USD->quote_currency === "USD"){
               $subtotal = round($subtotal/$USDrate,2);
           }
    
?>
                
    <tr>
    <td> <a href="
         <?php echo site_url('quotes/view/' . $quote_USD->quote_id); ?> ">
         <?php echo $quote_USD->quote_number; ?> </a></td>
    
    <td> <?php echo $quote_USD->quote_date_printed; ?></td>
    
    <td> <?php echo $subtotal . ' EUR';
    if($quote_USD->quote_currency === "USD"){
       echo '(' . $quote_USD->quote_item_subtotal . ' USD)';
    }
    
    
     if (strpos($groupName, 'Print') === false) {
    $CURRENT_TOTAL = $CURRENT_TOTAL + $subtotal;
     }
     $increase = 0.01;
       if($CURRENT_TOTAL<=3800){
          $percentHard = 0.1;
          $percentStandard = 0.08;
          $percentEasy = 0.06;
          }
    
      if($CURRENT_TOTAL>3800){
          $percentHard = 0.11;
          $percentStandard = 0.09;
          $percentEasy = 0.07;
      }

      if($CURRENT_TOTAL>5200){
          $percentHard = 0.11 + $increase;
          $percentStandard = 0.09+ $increase;
          $percentEasy = 0.07+ $increase;
      }

       if($CURRENT_TOTAL>6200){
          $percentHard = 0.11+ $increase*2;
          $percentStandard = 0.09+ $increase*2;
          $percentEasy = 0.07+ $increase*2;
      }

      if($CURRENT_TOTAL>7500){
          $percentHard = 0.11+ $increase*3;
          $percentStandard = 0.09+ $increase*3;
          $percentEasy = 0.07+ $increase*3;
      }
        ?>
    <td>
        <?php
        echo $groupName;
        ?>
    </td>
        
        
 
     <td> <?php 
        
        if (strpos($groupName, 'Hard') !== false) {
            $value = round($subtotal*$percentHard,2);
    echo $value. " (". $percentHard*100 . "%)";
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else if (strpos($groupName, 'Standard') !== false) {
    $value = round($subtotal*$percentStandard,2);
    echo $value . " (". $percentStandard*100 . "%)";
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else if (strpos($groupName, 'Print')!== false){
    $value = round($subtotal*$percentPrint,2);
     echo $value. " (". $percentPrint*100 . "%)";
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else{
    $value = round($subtotal*$percentEasy,2);
    echo $value. " (". $percentEasy*100 . "%)";
    $TOTAL_EUR=$TOTAL_EUR+$value;
}

echo ' EUR';
        
        ?></td>
     
     </tr>
            
            <?php }?>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>TOTAL EUR: </td>
    <td><?php echo $TOTAL_EUR . ' EUR'; ?></td>
</tr>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>TOTAL TURNOVER: </td>
    <td><?php echo $CURRENT_TOTAL . ' EUR'; ?></td>
</tr>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>QUOTE COUNT: </td>
    <td><?php echo sizeof($allQuotes); ?></td>
</tr>
            </tbody>

        </table>
    </div>
     
