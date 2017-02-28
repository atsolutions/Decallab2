<div id="headerbar">
    <h1><?php echo 'Quotes Printed this month'; ?></h1>
    
</div>

<div id="content" class="table-content">
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
    <td> <?php echo $quote_USD->quote_item_subtotal . ' USD' ; ?></td>
    <td> <?php echo $group['group_name']; ?></td>
    
    
        <td> <?php 
        
        if (strpos($group['group_name'], 'Hard') !== false) {
    echo $quote_USD->quote_item_subtotal*0.1;
    $TOTAL_USD=$TOTAL_USD+$quote_USD->quote_item_subtotal*0.1;
}else if (strpos($group['group_name'], 'Standard') !== false) {
    echo $quote_USD->quote_item_subtotal*0.08;
    $TOTAL_USD=$TOTAL_USD+$quote_USD->quote_item_subtotal*0.08;
}else{
    echo $quote_USD->quote_item_subtotal*0.06;
    $TOTAL_USD=$TOTAL_USD+$quote_USD->quote_item_subtotal*0.06;
}

echo ' USD';
        
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
    <td>TOTAL USD: </td>
    <td><?php echo $TOTAL_USD . ' USD'; ?></td>
</tr>

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

