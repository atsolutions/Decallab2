<html>
	<head>
		<title><?php echo lang('sales_by_date'); ?></title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/reports.css" type="text/css">
		
	</head>
        
        <body>
<h1 style="color: #5e9ca0; text-align: center;"><span style="color: #000000;">Monthly report</span></h1>
<h2 style="color: #2e6c80; text-align: left;">Total data:</h2>
<table style="height: 70px;" width="775">
<tbody>
<tr>
<td>&nbsp;</td>
<td>This month</td>
<td>Previous month</td>
<td>YTD</td>
<td>LYTD</td>
</tr>
<tr>
<td>Number of new Quotes</td>
<td>
    <?php echo $this->suds; ?>
    <?php echo 'SHIT'; ?>
    <?php echo $data->suds; ?>
    <?php echo 'SHIT2'; ?>
    <?php echo $result->suds; ?>
    <?php echo 'SHIT2'; ?>
    <?php print_r($results); ?>
    <?php print_r($data); ?>
    <?php print_r($result); ?>
</td>







<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Number of new Invoices</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Turnover (Quotes)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Turnover (Invoices)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<h2 style="color: #2e6c80; text-align: left;">Personal data:</h2>
<table style="height: 59px;" width="776">
<tbody>
<tr>
<td>Name</td>
<td>This month</td>
<td>Previous month</td>
<td>YTD</td>
<td>LYTD</td>
</tr>
<tr>
<td>Martins Klavins</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Aigars Berzins</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<h2 style="color: #2e6c80; text-align: left;">Designer data:</h2>
<table style="height: 78px;" width="777">
<tbody>
<tr>
<td>Name</td>
<td>Current Quotes</td>
<td>Finished (this month)</td>
<td>Finished (previous month)</td>
<td>Turnover (this month)</td>
<td>Turnover (previous month)</td>
</tr>
<tr>
<td>Arta Jermaka</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Kasims</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Valts</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>

        </body>
</html>