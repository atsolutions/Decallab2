<style>

@font-face { 
font-family: Calm; 
src: url('<?php echo base_url(); ?>assets/default/fonts/KeepCalm/KeepCalm-Medium.ttf'); 
} 

#header {
    background-color:#232323;
    color:white;
    text-align:center;
    padding:5px;
	height: auto;
}

#main {
    float:center;
    padding:10px; 
	background-color:#EDEFF0;
	font-family: Calm, sans-serif;
	min-height:80%;
}
#content {
    float:center;
    padding:10px; 
	background-color:#EDEFF0;
	width:800px;
	display: block;
    margin-left: auto;
    margin-right: auto;
	color: #575757;
	font-family: Calm, sans-serif;
	font-size: 14px;
	
	
}

#vcenter {
    float:center;
    padding-top: 10%;
	background-color:#EDEFF0;
	width:800px;
	display: block;
    margin-left: 0;
    margin-right: 0;
	color: #575757;
	font-family: Calm, sans-serif;
	font-size: 14px;
	
	
}

#footer {
    background-color:#232323;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;
	font-family: Calm, sans-serif;
	font-size: 8pt;
	color: #9B9B9B;
	position: fixed;
	bottom: 0;
	left: 0;
   width: 100%;
   height 50px;
}

# footertext {
    display: block;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
	
}
</style>

<head>
<!-- included scripts not known which are really neccesary -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="NOINDEX,NOFOLLOW">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/default/img/favicon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
 </head>
 
 
 <body>

<div id="header">
<img src="<?php echo base_url(); ?>assets/default/img/Logo1.png" width="700"></img>
</div>



<div id="main">


<div id="content">
<h2 align="right"> Hello <?php echo $quote->client_name; ?>! </h2>
<p align = "right"> Welcome to Decallab order management system </p>
<div id="vcenter">
<h2>THANK YOU!</h2>
<h4>Your corrections has been sent to DECALLAB team!</h4>
<p> We will send you corrected design as soon as possible! </p>
<hr style="BORDER-RIGHT: medium none; BORDER-TOP: #9B9B9B 3px solid; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; HEIGHT: 1px"> 

</div>
</div>
</div>

<div id="footer">
<img src="<?php echo base_url(); ?>assets/default/img/Logo1.png" width="300px"></img>
<center>
<p id = "footertext"> SIA "Decallab" </p>
<p id = "footertext"> Mailing address: Unijas iela 4, Riga, LV-1084, Latvia</p>
<p id = "footertext"> Office address: Brivibas gatve 214b, Riga, LV-1084, Latvia</p>
<p id = "footertext"> GSM: 00 371 26348589 (Martins) </p>
<p id = "footertext"> GSM: 00 371 29477824 (Aigars) </p>
<p id = "footertext"> Email: info@decallab.eu </p>
</center>
</div>

</body>

