<style>

@font-face { 
font-family: Calm; 
src: url('<?php echo base_url(); ?>assets/default/fonts/KeepCalm/KeepCalm-Medium.ttf'); 
} 
.fileupload-buttonbar .btn,
.fileupload-buttonbar .toggle {
  margin-bottom: 5px;
}
.progress-animated .progress-bar,
.progress-animated .bar {
  background: url("../img/progressbar.gif") !important;
  filter: none;
}
.fileupload-process {
  float: right;
  display: none;
}
.fileupload-processing .fileupload-process,
.files .processing .preview {
  display: block;
  width: 32px;
  height: 32px;
  background: url("../img/loading.gif") center no-repeat;
  background-size: contain;
}
.files audio,
.files video {
  max-width: 300px;
}

@media (max-width: 767px) {
  .fileupload-buttonbar .toggle,
  .files .toggle,
  .files .btn span {
    display: none;
  }
  .files .name {
    width: 80px;
    word-wrap: break-word;
  }
  .files audio,
  .files video {
    max-width: 80px;
  }
  .files img,
  .files canvas {
    max-width: 100%;
  }
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
	height: auto;
}
#content {
    float:center;
    padding:10px; 
	background-color:#EDEFF0;
	width:900px;
	display: block;
    margin-left: auto;
    margin-right: auto;
	color: #575757;
	font-family: Calm, sans-serif;
	font-size: 14px;

	
	
}

#vcenter {
    float:center;
    padding-top: 60px;
	background-color:#EDEFF0;
	width:900px;
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

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: #575656;
    cursor: inherit;
    display: block;
}

#buttons {
	padding-top: 15px;
	
}

.btn-default {
    background: #575656;
    color: #575656;
}

#filelist {
	float: right;
	padding-top: 5px;
	
}


#invoice-container {
                margin: 25px auto;
                width: 900px;
                padding: 20px;
                background-color: white;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
				font-family: sans-serif;
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
			.pull-left {
			padding-top: 40px;	
			padding-bottom: 20px;
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
	<script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.11.2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap-3.3.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.11.2.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/default/js/libs/dropzone.js?version=1"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery.elevatezoom.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery.elevateZoom-3.0.8.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.8.3.min.js"></script>

 </head>

<script language=JavaScript> //checking characters in textbox



//function to check for commen length
function check_length(comments)
{
maxLen = 2000; // max number of characters allowed
if (comments.my_text.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "You have reached your maximum limit of characters allowed";
alert(msg);
// Reached the Maximum length so trim the textarea
	comments.my_text.value = comments.my_text.value.substring(0, maxLen);
}
else{ // Maximum length not reached so update the value of my_text counter
	comments.text_num.value = maxLen - comments.my_text.value.length;
}
}

$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        name = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});


$(document).ready(function(){
$("input[type='files[]']").on("change", function(){
$("#fileform").submit();
});
}); 

$('#zoom').elevateZoom({ 
	zoomType: "inner", 
	cursor: "crosshair",
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 750
});

</script> 

<script language="javascript"> //Warnings when submitting

function approved() {
window.alert("You have approved this design. Thank you!");
}

function rejected() {
window.alert("You have rejected this design. Comments have been sent to Decallab team They are working on it. Thank you!");
}

document.addEventListener("DOMContentLoaded", init, false);
    
function init() {
        document.querySelector('#filesToUpload').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
function handleFileSelect(e) {
        
        if(!e.target.files) return;
        
        selDiv.innerHTML = "";
        
        var files = e.target.files;
        for(var i=0; i<files.length; i++) {
            var f = files[i];
            
            selDiv.innerHTML += f.name + "<br/>";

        }
        
    }
</script>

<body>

<?php //submitting script

$desired_dir= getcwd() . "/uploads/customer_files/";
		if(isset($_POST['approve'])){ //check if form was submitted

			if(isset($_FILES['files'])){
				$errors= array();
				foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
					$file_name = $quote->quote_url_key . "_" . $_FILES['files']['name'][$key];
					$file_size =$_FILES['files']['size'][$key];
					$file_tmp =$_FILES['files']['tmp_name'][$key];
					$file_type=$_FILES['files']['type'][$key];
					echo $file_name;
						
					//$query="INSERT into upload_data (`USER_ID`,`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`) VALUES('$user_id','$file_name','$file_size','$file_type'); ";
					
					
					if(empty($errors)==true){
						if(is_dir($desired_dir)==false){
							mkdir("$desired_dir", 0700);		// Create directory if it does not exist
						}
						if(is_dir("$desired_dir/".$file_name)==false){
							move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
						}else{									// rename the file if another one exist
							$new_dir="$desired_dir/".$file_name.time();
							 rename($file_tmp,$new_dir) ;				
						}
						$data = array(
					'client_id' => $quote->client_id,
					'url_key' => $quote->quote_url_key,
					'file_name_original' => $_FILES['files']['name'][$key],
					'file_name_new' => $file_name
					);
					$this->db->get('ip_uploads');
					$this->db->insert('ip_uploads', $data);
						
					// mysql_query($query);			
					}else{
							print_r($errors);
					}
				}
				/*if(empty($error)){
					echo "Success";
				}*/

			}
			
			$comment = $_POST['my_text']; //get input text
			echo 'You have approved it!' . $comment;
			print_r($_POST);
					$this->db->get('ip_quotes');
					$this->db->where('quote_id', $quote->quote_id);
					$this->db->set('notes', $comment);
					$this->db->update('ip_quotes');
					
$data = array(
   'author' => $quote->client_name,
   'action' => 'has approved quote ' . $quote->quote_number ,
   'action_date' => date('Y-m-d H:i:s'),
   'action_link' => site_url('quotes/view/') .'/'. $quote->quote_id,
   'type' => '1'
);

$this->db->insert('ip_actions', $data); 
					
				
			redirect('guest/view/approve_quote/' . $quote->quote_url_key . '/' . $quote->quote_id);
			
			
		}elseif (isset($_POST['correct'])){
			if(isset($_FILES['files'])){
				$errors= array();
				foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
					$file_name = $quote->quote_url_key . "_" . $_FILES['files']['name'][$key];
					$file_size =$_FILES['files']['size'][$key];
					$file_tmp =$_FILES['files']['tmp_name'][$key];
					$file_type=$_FILES['files']['type'][$key];
					echo $file_name;

							
					
					if(empty($errors)==true){
						if(is_dir($desired_dir)==false){
							mkdir("$desired_dir", 0700);		// Create directory if it does not exist
						}
						if(is_dir("$desired_dir/".$file_name)==false){
							move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
						}else{									// rename the file if another one exist
							$new_dir="$desired_dir/".$file_name.time();
							 rename($file_tmp,$new_dir) ;				
						}
					$data = array(
					'client_id' => $quote->client_id,
					'url_key' => $quote->quote_url_key,
					'file_name_original' => $_FILES['files']['name'][$key],
					'file_name_new' => $file_name
					);
					$this->db->get('ip_uploads');
					$this->db->insert('ip_uploads', $data);
						
		
					}else{
							print_r($errors);
					}
				}
				}
			
			$comment = $_POST['my_text']; //get input text
			echo 'You have rejected it ' . $comment;
					$this->db->get('ip_quotes');
					$this->db->where('quote_id', $quote->quote_id);
					$this->db->set('notes', $comment);
					$this->db->update('ip_quotes');
					
//insert activiy in log
$data = array(
   'author' => $quote->client_name,
   'action' => 'has rejected quote ' . $quote->quote_number ,
   'action_date' => date('Y-m-d'),
   'action_link' => site_url('quotes/view/') .'/'. $quote->quote_id,
   'type' => '2'
);

$this->db->insert('ip_actions', $data); 

			redirect('guest/view/reject_quote/' . $quote->quote_url_key . '/' . $quote->quote_id);
}
?>



<div id="header">
<img src="<?php echo base_url(); ?>assets/default/img/Logo1.png" width="700"></img>
</div>



<div id="main">


<div id="content">
<h2 align="right"> Hello <?php echo $quote->client_name; ?>! </h2>

<p align = "right"> Welcome to Decallab order management system </p>
<hr style="BORDER-RIGHT: medium none; BORDER-TOP: #9B9B9B 3px solid; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; HEIGHT: 1px"> 
<div id="vcenter">


<h2>THIS IS YOUR DESIGN</h2>
<h4>Check the design and send us a message using this form.</h4>


<form action="" method="post" name= "comments" enctype="multipart/form-data">
<textarea style="width:900px; border:solid 3px #9B9B9B padding-top:100px" rows="9;" onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); name=my_text
placeholder=""></textarea>


<div id="buttons">
<table width="100%">
<tr>
<td align = "left" width="33%" >
<button onclick="approved()" type="submit" name ="approve"class="btn btn-success btn-block"><h4>Approve this design</h4></button>
</td>
<td align="center" width="33%">
<button onclick="rejected()"type="submit" name="correct" class="btn btn-primary btn-block"><h4>Send corrections</h4></button>
</td>
<td align = "right" width="33%">
<span  class="btn btn-default btn-file btn-block"><span><h4>Attach files</h4></span><input id="filesToUpload" type="file" name="files[]" multiple="multiple"></input></span>
</td>
</tr>
</table>

</div>
</form>

<div id="filelist">
<p><b>Files selected for upload:</b></p>
<div id="selectedFiles"></div>
</div>

</div>

<div id ="uploaded_images">

<?php
$string = 'uploads/customer_files/' . $quote->quote_url_key . '*.{[jJ][pP][gG],[pP][nN][gG],[gG][iI][fF]}'; 
		
			$files = array();
			$files = glob($string, GLOB_BRACE);
			foreach ($files as $file){ ?>
<a href = <?php echo site_url($file) ?> target="_blank">
 <img id="zoom" src = <?php echo site_url($file) ?> data-zoom-image="<?php echo site_url($file) ?>" height="auto" width="900">
 </a>
 
<?php } ?>

<br>
<br>
<p> Click on image to see full size </p>
<hr style="BORDER-RIGHT: medium none; BORDER-TOP: #9B9B9B 3px solid; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; HEIGHT: 1px"> 
</div>
<h1 style="padding-top: 60px"> THIS IS YOUR QUOTE </h1>
<div id="invoice-container"> 

            <div id="quote">
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
									
                                        <td><?php echo lang('total'); ?></td>
                                        <td style="text-align:right;"><?php echo $quote->quote_total . ' ' . $quote->quote_currency; ?></td>
										
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
                            <th><?php echo lang('price'); ?></th>
                            <th><?php echo lang('total'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?php echo $item->item_name; ?></td>
                                <td><?php echo nl2br($item->item_description); ?></td>
                                <td><?php echo format_amount($item->item_quantity); ?></td>
                                <td><?php echo $item->item_price . ' ' . $quote->quote_currency; ?></td>
                                <td><?php echo $item->item_subtotal . ' ' . $quote->quote_currency; ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3"></td>
                             <td><?php echo lang('subtotal'); ?>:</td>
                             <td><?php echo $quote->quote_item_subtotal . ' ' . $quote->quote_currency; ?></td>
                        </tr>
                        <?php if ($quote->quote_item_tax_total > 0) { ?>
                        <tr>
                                <td class="no-bottom-border" colspan="3"></td>
                               <td><?php echo lang('item_tax'); ?></td> 
                                <td><?php echo $quote->quote_item_tax_total . ' ' . $quote->quote_currency; ?></td> 
                        </tr>
                        <?php } ?>
                        <?php foreach ($quote_tax_rates as $quote_tax_rate) : ?>
                            <tr>    
                                <td class="no-bottom-border" colspan="3"></td>
                                <td><?php echo $quote_tax_rate->quote_tax_rate_name . ' ' . $quote_tax_rate->quote_tax_rate_percent; ?>%</td>
                                <td><?php echo $quote_tax_rate->quote_tax_rate_amount . ' ' . $quote->quote_currency; ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td><b><?php echo lang('total'); ?>:</b></td>
                            <td><b><?php echo $quote->quote_total . ' ' . $quote->quote_currency; ?></b></td> 
                        </tr>
                    </tbody>
                </table>
			

	            
<div class="pull-left">
<a href="<?php echo site_url('guest/view/generate_quote_pdf/' . $quote_url_key); ?>" style="text-decoration: none" class="btn btn-primary"><i class="fa fa-print"></i> <?php echo lang('download_pdf'); ?></a> 

			
			</div>

            </div>

        </div>

<hr style="BORDER-RIGHT: medium none; BORDER-TOP: #9B9B9B 3px solid; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; HEIGHT: 1px; width:100%"> 

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

