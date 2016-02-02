<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php
        if ($this->mdl_settings->setting('custom_title') != '') {
            echo $this->mdl_settings->setting('custom_title');
        } else {
            echo 'InvoicePlane';
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
			#Myimage{
				height: auto; 
				width: auto; 
				max-width: 300px; 
				max-height: 300px;
			}
        </style>

    </head>

    <body>

        <div id="menu-container">
		
<h1> REJECTED </h1>
<?php if (!empty($_POST)): ?>
	Thank you your comment, <?php echo htmlspecialchars($_POST["comment"]); ?> Has been received!<br>
	<p><?php echo site_url('guest/view/submitted/' . $_POST["comment"]); ?>"</p>
    
<?php else: ?>
    <form action="" method="post" id="usrform">
        <input type="submit">
    </form>
	<textarea name="comment" form="usrform">Enter your comments here .... </textarea>
<?php endif; ?>
			
			</div>

			
<?php $string = 'uploads/customer_files/' . $quote->quote_url_key . '*.jpg';  ?>
			<?php
			$files = array();
			$files = glob($string);

 ?>
 </div>
 <a href = <?php echo site_url($files[0]) ?> target="_blank">
 <img src = <?php echo site_url($files[0]) ?> height="auto" width="945">
</a>

</body>
</html>