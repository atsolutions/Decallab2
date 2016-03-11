<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/default/img/favicon.png">



    <script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.11.2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap-3.3.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.11.2.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/dropzone.js"></script>

        <title><?php
        if ($this->mdl_settings->setting('custom_title') != '') {
        echo $this->mdl_settings->setting('custom_title');
        } else {
        } ?> - <?php echo lang('quote'); ?> <?php echo $quote->quote_number; ?></title>

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/templates.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/custom.css">

        <style>
            body {
                color: #333 !important;
                padding: 0 0 25px;
                height: auto;
            }
            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
                margin-bottom: 15px;
            }
            #header table td {
                vertical-align: text-top;
            }
            #invoice-to {
                margin-bottom: 15px;
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to h3 {
                margin-bottom: 10px;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
            .alignr {
                text-align: right;
            }
            #invoice-container {
                margin: 25px auto;
                width: 900px;
                padding: 20px;
                background-color: white;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
            }
            #menu-container {
                margin: 25px auto;
                width: 900px;
            }
            .flash-message {
                font-size: 120%;
                font-weight: bold;
            }
        </style>

    </head>

    <body>
	<br>
	<br>
<?php
$string = 'uploads/customer_files/' . $quote->quote_url_key . '*.{[jJ][pP][gG],[pP][nN][gG],[gG][iI][fF]}'; 
$files = array();
$files = glob($string, GLOB_BRACE);
foreach ($files as $file){ ?>
<a href = <?php echo site_url($file) ?> target="_blank">
<img src = <?php echo site_url($file) ?> height="auto" width="900">
</a>
 
<?php } ?>
<header>
<br>
<b>
<?php echo 'Notes:';?>
</b>
<br>				
<?php echo $quote->notes;?>
<br>

<p><b> Click on links to download attached files: </b></p>

<?php
$string = 'uploads/customer_files/' . $quote->quote_url_key . '*.*'; 
		
$files = array();
$files = glob($string, GLOB_BRACE);
foreach ($files as $file){ ?>
<a href = "<?php echo site_url($file) ?>" download> <?php echo substr($file, 23)?> </a>
<br>
<?php } ?>
</a>



<div id="menu-container">
<div class="pull-right">
           <?php if ($quote->quote_status_id == 5) { ?>
	            <a href="#" class="btn btn-danger" style="text-decoration: none"><?php echo lang('quote_rejected'); ?></a>
	            <?php } elseif ($quote->quote_status_id == 7) {?>
				<a href="#" class="btn btn-primary" style="text-decoration: none"><?php echo 'First design'; ?></a>
<?php } ?>
            <?php if ($flash_message) { ?>
            <div class="alert flash-message">
                <?php echo $flash_message; ?>
            </div>
            <?php } ?>
			</div>

            <div class="clearfix"></div>
        </div>

        <div id="invoice-container">

            <div id="header">
                <table>
                    <tr>
                        <td id="company-name">
                            <?php echo invoice_logo(); ?>
                            <h2><?php echo $quote->user_company; ?></h2>
                            <p><?php if ($quote->user_vat_id) { echo lang("vat_id_short") . ": " . $quote->user_vat_id . '<br>'; } ?>
                                <?php if ($quote->user_tax_code) { echo lang("tax_code_short") . ": " . $quote->user_tax_code . '<br>'; } ?>
                                <?php if ($quote->user_address_1) { echo $quote->user_address_1 . '<br>'; } ?>
                                <?php if ($quote->user_address_2) { echo $quote->user_address_2 . '<br>'; } ?>
                                <?php if ($quote->user_city) { echo $quote->user_city . ' '; } ?>
                                <?php if ($quote->user_state) { echo $quote->user_state . ' '; } ?>
                                <?php if ($quote->user_zip) { echo $quote->user_zip . '<br>'; } ?>
                                <?php if ($quote->user_phone) { ?><?php echo lang('phone_abbr'); ?>: <?php echo $quote->user_phone; ?><br><?php } ?>
                                <?php if ($quote->user_fax) { ?><?php echo lang('fax_abbr'); ?>: <?php echo $quote->user_fax; ?><?php } ?>
                            </p>
                        </td>
                        <td class="alignr"><h2><?php echo lang('quote'); ?> <?php echo $quote->quote_number; ?></h2></td>
                    </tr>
                </table>
            </div>
            <div id="invoice-to">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h3><?php echo $quote->client_name; ?></h3>
                            <p><?php if ($quote->client_vat_id) { echo lang("vat_id_short") . ": " . $quote->client_vat_id . '<br>'; } ?>
                                <?php if ($quote->client_tax_code) { echo lang("tax_code_short") . ": " . $quote->client_tax_code . '<br>'; } ?>
                                <?php if ($quote->client_address_1) { echo $quote->client_address_1 . '<br>'; } ?>
                                <?php if ($quote->client_address_2) { echo $quote->client_address_2 . '<br>'; } ?>
                                <?php if ($quote->client_city) { echo $quote->client_city . ' '; } ?>
                                <?php if ($quote->client_state) { echo $quote->client_state . ' '; } ?>
                                <?php if ($quote->client_zip) { echo $quote->client_zip . '<br>'; } ?>
                                <?php if ($quote->client_phone) { ?><?php echo lang('phone_abbr'); ?>: <?php echo $quote->client_phone; ?><br><?php } ?>
                            </p>
                        </td>
                        <td style="width:30%;"></td>
                        <td style="width:25%;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('quote_date'); ?></td>
                                        <td style="text-align:right;"><?php echo date_from_mysql($quote->quote_date_created); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('expires'); ?></td>
                                        <td style="text-align:right;"><?php echo date_from_mysql($quote->quote_date_expires); ?></td>
                                    </tr>
                                    <tr>
									

										
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="invoice-items">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo lang('item'); ?></th>
                            <th><?php echo lang('description'); ?></th>
							<th><?php echo lang('qty'); ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?php echo $item->item_name; ?></td>
                                <td><?php echo nl2br($item->item_description); ?></td>
                                <td><?php echo format_amount($item->item_quantity); ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3"></td>
 
                        </tr>
                        <?php if ($quote->quote_item_tax_total > 0) { ?>
                        <tr>
                                <td class="no-bottom-border" colspan="3"></td>

                        </tr>
                        <?php } ?>
                        <?php foreach ($quote_tax_rates as $quote_tax_rate) : ?>
                            <tr>    
                                <td class="no-bottom-border" colspan="3"></td>

                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>

                        </tr>
                    </tbody>
                </table>
			

	            

            
                <footer>

</footer>
            </div>

        </div>
    </body>
</html>