
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/templates.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/custom-pdf.css">
    <html>
        <body>
            <div page-break-after: always>
<h1 style="color: #5e9ca0; text-align: center;"><strong>Monthly report</strong></h1>
<p><strong>From: <?php echo $results['start'] ?></strong></p>
<p><strong>To: <?php echo $results['end'] ?></strong></p>
<p><strong>Created: <?php echo $results['today'] ?></strong></p>
<p>&nbsp;</p>

<?php 

foreach ($results['user_data'] as $user_data) {
    ?>
<strong>
<?php
echo 'DESIGNER:' . $user_data['user_name'];
echo '<br>';
?>
</strong>
<?php
if(is_array($user_data)){
    foreach($user_data as $group_data){
        ?>
<strong>
    <?php

    if($group_data['size']!=0){
    
        echo 'QUOTE TYPE:' . $group_data['group_name'];
        echo '<br>';
        ?>
</strong>


<table class="item-table">
        <thead>
        <tr>
            <th class="item-name"><?php echo 'Quote number'; ?></th>
            <th class="item-desc"><?php echo 'Print date'; ?></th> 
            <th class="item-desc"><?php echo 'Quote total'; ?></th>    
        </tr>
        </thead>
        </tbody>
</table>
<?php if(count($group_data['USD'])!=0){ ?>
        USD
        
<table class="item-table">
    <tbody>
<?php 

    

$TOTAL = 0;
foreach($group_data['USD'] as $quote_USD){ ?>
<tr>
    <td> <?php echo $quote_USD->quote_number; ?></td>
    <td> <?php echo $quote_USD->quote_date_printed; ?></td>
    <td> <?php echo $quote_USD->quote_item_subtotal; ?></td>
    <?php $TOTAL = $TOTAL+$quote_USD->quote_item_subtotal; ?>
</tr>

    <?php } ?>
<tr>
    <td> </td>
    <td> <?php echo 'TOTAL' ?></td>
<td> <?php  echo $TOTAL . ' USD';} ?></td> 
</tr>

</tbody>
</table>
        <?php if(count($group_data['EUR'])!=0){ ?>
EUR
<table class="item-table">
    <tbody>
<?php
$TOTAL = 0;
if(!empty($group_data['EUR'])){
foreach($group_data['EUR'] as $quote_USD){ ?>
<tr>
    <td> <?php echo $quote_USD->quote_number; ?></td>
    <td> <?php echo $quote_USD->quote_date_printed; ?></td>
    <td> <?php echo $quote_USD->quote_item_subtotal; ?></td> 
    <?php $TOTAL = $TOTAL+$quote_USD->quote_item_subtotal; ?>
</tr>

    <?php }} ?>
<tr>
    <td></td>
    <td> <?php echo 'TOTAL' ?></td>
    <td> <?php echo $TOTAL . ' EUR';}} ?></td> 
</tr>
</tbody>
</table>



<?php
    } 
}

?>

    <?php
}
?>

            </div>
