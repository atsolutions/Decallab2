<div id="headerbar">
    <h1><?php 
    echo 'Quotes Printed'; ?></h1>
    
</div>

        <?php 
     $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"); 
        foreach($XML->Cube->Cube->Cube as $rate){ 
                    
      if($rate["currency"]=='USD'){
    $exchange = (string)$rate["rate"];
    $USDrate = floatval($exchange);
    break;
      }

  } 
        
        
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
            $TOTAL_USD = 0;
            $TOTAL_EUR = 0;
            
            
            foreach ($data as $group) {
                    foreach($group['USD'] as $quote_USD){ ?>
<tr>
    <td> <a href="<?php echo site_url('quotes/view/' . $quote_USD->quote_id); ?> "> <?php echo $quote_USD->quote_number; ?> </a></td>
    <td> <?php echo $quote_USD->quote_date_printed; ?></td>
    <td> <?php echo round($quote_USD->quote_item_subtotal/$USDrate,2) . ' EUR ('. $quote_USD->quote_item_subtotal . ' USD)'  ; ?></td>
    <td> <?php echo $group['group_name']; ?></td>
    
    
        <td> <?php 
        
        if (strpos($group['group_name'], 'Hard') !== false) {
            $value = round($quote_USD->quote_item_subtotal*0.1/$USDrate,2);
    echo $value;
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else if (strpos($group['group_name'], 'Standard') !== false) {
    $value = round($quote_USD->quote_item_subtotal*0.08/$USDrate,2);
    echo $value;
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else if (strpos($group['group_name'], 'Print')!== false){
    $value = round($quote_USD->quote_item_subtotal*0.02/$USDrate,2);
     echo $value;
    $TOTAL_EUR=$TOTAL_EUR+$value;
}else{
    $value = round($quote_USD->quote_item_subtotal*0.06/$USDrate,2);
    echo $value;
    $TOTAL_EUR=$TOTAL_EUR+$value;
}

echo ' EUR';
        
        ?></td>
    
</tr>
            <?php }
            foreach($group['EUR'] as $quote_USD){ ?>
<tr>
    <td> <a href="<?php echo site_url('quotes/view/' . $quote_USD->quote_id); ?> "> <?php echo $quote_USD->quote_number; ?></a></td>
    <td> <?php echo $quote_USD->quote_date_printed; ?></td>
    <td> <?php echo $quote_USD->quote_item_subtotal . ' EUR' ; ?></td>
    <td> <?php echo $group['group_name']; ?></td>
    <td> <?php 
        
        if (strpos($group['group_name'], 'Hard') !== false) {
    echo $quote_USD->quote_item_subtotal*0.1;
    $TOTAL_EUR=$TOTAL_EUR+$quote_USD->quote_item_subtotal*0.1;
}else if (strpos($group['group_name'], 'Standard') !== false) {
    echo $quote_USD->quote_item_subtotal*0.08;
    $TOTAL_EUR=$TOTAL_EUR+$quote_USD->quote_item_subtotal*0.08;
}else if (strpos($group['group_name'], 'Print')!== false){
     echo $quote_USD->quote_item_subtotal*0.02;
    $TOTAL_EUR=$TOTAL_EUR+$quote_USD->quote_item_subtotal*0.02;
}else{
    echo $quote_USD->quote_item_subtotal*0.06;
    $TOTAL_EUR=$TOTAL_EUR+$quote_USD->quote_item_subtotal*0.06;
}
        echo ' EUR';
        ?></td>
</tr>
            
            <?php }}?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>TOTAL EUR: </td>
    <td><?php echo $TOTAL_EUR . ' EUR'; ?></td>
</tr>
            </tbody>

        </table>
    </div>

