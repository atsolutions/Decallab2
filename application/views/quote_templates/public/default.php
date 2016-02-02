<!doctype html>

<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<script language=JavaScript>
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



</script>

<head>

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
    background: white;
    cursor: inherit;
    display: block;
}

div.ex1 {
    width:900px;
    margin: auto;
    border: 3px solid #73AD21;
}
			
			
			
        </style>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/templates.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/custom.css">

    </head>
	
    <body>
	
<div id ="uploaded_images">
<?php $string = 'uploads/customer_files/' . $quote->quote_url_key . '*.{[jJ][pP][gG],[pP][nN][gG],[gG][iI][fF]}';  ?>
			<?php
			$files = array();
			$files = glob($string, GLOB_BRACE);

 ?>

 <?php foreach ($files as $file) : ?>
 <a href = <?php echo site_url($file) ?> target="_blank">
 <img src = <?php echo site_url($file) ?> height="auto" width="900">
 </a>
<br>
 <?php endforeach ?>
<br>
</div>


<div id="menu-container">

<?php

$desired_dir= "/var/www/html/Decallab/uploads/customer_files/";

		if(isset($_POST['approve'])){ //check if form was submitted
			if(isset($_FILES['files'])){
				$errors= array();
				foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
					$file_name = $quote->quote_url_key . "_" . $_FILES['files']['name'][$key];
					$file_size =$_FILES['files']['size'][$key];
					$file_tmp =$_FILES['files']['tmp_name'][$key];
					$file_type=$_FILES['files']['type'][$key];
					echo $file_name;
					if($file_size > 2097152){
						$errors[]='File size must be less than 2 MB';
					}		
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
			echo '<script language="javascript">';
			echo 'alert("Yout comments have been sent to Decallab team. Thank you!")';
			echo '</script>';
					
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

					if($file_size > 2097152){
						$errors[]='File size must be less than 2 MB';
					}		
					
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
						
					//$query="INSERT into ip_uploads(`client_id`,`url_key`,`file_name_original`,`file_name_new`) VALUES('$quote->client_id','$quote->quote_url_key','$_FILES['files']['name'][$key]','$file_name'); ";
					//mysql_query($query);			
					}else{
							print_r($errors);
					}
				}
				/*if(empty($error)){
					echo "Success";
				}*/

				}
			
			$comment = $_POST['my_text']; //get input text
			echo 'You have rejected it ' . $comment;
					$this->db->get('ip_quotes');
					$this->db->where('quote_id', $quote->quote_id);
					$this->db->set('notes', $comment);
					$this->db->update('ip_quotes');
					//redirect for file upload
			echo '<script language="javascript">';
			echo 'alert("Yout comments have been sent to Decallab team. Thank you!")';
			echo '</script>';
			redirect('guest/view/reject_quote/' . $quote->quote_url_key . '/' . $quote->quote_id);
		}
?>


			<div class="pull-right">
	            <?php if (in_array($quote->quote_status_id, array(2,3))) { ?>
				
						<form action="" method="post" name= "comments" enctype="multipart/form-data">
							<textarea style="width:900px;" rows="4;" onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
							name=my_text>Enter your corrections/comments here ... Attach files if neccesary</textarea>
							<input size=1 value=2000 name=text_num> Characters Left
							
							<div class="pull-right">
								<label class="control-label"><?php echo lang('attachments'); ?></label>
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-default btn-file"><span>Choose file</span><input id="btn btn-sucess" type="file" name="files[]" multiple="multiple"></span>
								<button type="submit" name ="approve"class="btn btn-success">Approve this quote</button>
								<button type="submit" name="correct" class="btn btn-danger">Send corrections</button>

							</div>
							
					
	            <?php } elseif ($quote->quote_status_id == 4) { ?>
	            <a href="#" class="btn btn-success" style="text-decoration: none"><?php echo lang('quote_approved'); ?></a>
	            <?php } elseif ($quote->quote_status_id == 5) { ?>
	            <a href="#" class="btn btn-danger" style="text-decoration: none"><?php echo lang('quote_rejected'); ?></a>
	            <?php } ?>
				
			</div>


            <?php if ($flash_message) { ?>
            <div class="alert flash-message">
                <?php echo $flash_message; ?>
            </div>
            <?php } ?>



			
			
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
									
                                        <td><?php echo lang('total'); ?></td>
                                        <td style="text-align:right;"><?php echo format_currency($quote->quote_total); ?></td>
										
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
                                <td><?php echo format_currency($item->item_price); ?></td>
                                <td><?php echo format_currency($item->item_subtotal); ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3"></td>
                             <td><?php echo lang('subtotal'); ?>:</td>
                             <td><?php echo format_currency($quote->quote_item_subtotal); ?></td>
                        </tr>
                        <?php if ($quote->quote_item_tax_total > 0) { ?>
                        <tr>
                                <td class="no-bottom-border" colspan="3"></td>
                               <td><?php echo lang('item_tax'); ?></td> 
                                <td><?php echo format_currency($quote->quote_item_tax_total); ?></td> 
                        </tr>
                        <?php } ?>
                        <?php foreach ($quote_tax_rates as $quote_tax_rate) : ?>
                            <tr>    
                                <td class="no-bottom-border" colspan="3"></td>
                                <td><?php echo $quote_tax_rate->quote_tax_rate_name . ' ' . $quote_tax_rate->quote_tax_rate_percent; ?>%</td>
                                <td><?php echo format_currency($quote_tax_rate->quote_tax_rate_amount); ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td><b><?php echo lang('total'); ?>:</b></td>
                            <td><b><?php echo format_currency($quote->quote_total); ?></b></td> 
                        </tr>
                    </tbody>
                </table>
			

	            
<div class="pull-right">
				<a href="<?php echo site_url('guest/view/generate_quote_pdf/' . $quote_url_key); ?>" style="text-decoration: none" class="btn btn-primary"><i class="fa fa-print"></i> <?php echo lang('download_pdf'); ?></a> 
            </div>
            
            
  <footer>  
  <br>
</footer>
            </div>

        </div>


			



    </body>
</html>



