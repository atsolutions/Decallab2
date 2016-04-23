<script>
var Checked = new Array();


function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
				 add(checkboxes[i]);
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
				 add(checkboxes[i]);
             }
         }
     }
 }
 

 
 function add(ele){
	 if(ele.checked){
		 if(ele.id != 0){
		 Checked.push(ele.id);
		 }
	 }else{
		 var index = Checked.indexOf(ele.id);
		 if(index >-1){
		 Checked.splice(index,1);
		 }
	 }
document.getElementById("demo").innerHTML = Checked;
var dataset = Checked.toString();
var finaldata = dataset.replace(new RegExp(",", "g"),'_');
document.getElementById('btn_quotes_to_invoices').dataset.quote_id = finaldata;

 
}

 

function downloadfiles(){
	var origin = document.location.origin
	var url = origin.concat("/quotes/generate_pdf/")
	for (var i = 0; i < Checked.length; i++) {
		var url2 = url.concat(Checked[i])
		window.open(url2, "_blank")
	}
}

function deletequote(){
	var origin = document.location.origin
	var url = origin.concat("/quotes/delete/")
	var check = window.confirm("YOU ARE GOING TO DELETE SELECTED QUOTES. ARE YOU SURE?")
	if(check ==true){
		for (var i = 0; i < Checked.length; i++) {
			var url2 = url.concat(Checked[i])
			$.get(url2)
			window.close();
			location.reload();
		}
	}
	}
function selectdesigner(element) {
	var origin = document.location.origin
	var url3 = origin.concat("/quotes/status/all/0/");
	var url4 = url3.concat(element.value);
	document.getElementById("user").innerHTML = url4;
    window.open(url4 ,"_self");
}


</script>


<div class="table-responsive">
    <table class="table table-striped">
        <div id="demo"></div>
        <thead>
        <tr>
            <th><?php echo lang('status'); ?></th>
            <th><?php echo lang('quote'); ?></th>
            <th><?php echo lang('created'); ?></th>
            <th><?php echo lang('due_date'); ?></th>
            <th><?php echo lang('client_name'); ?></th>
			<th><?php echo 'ID' ?></th>
			<th><?php echo 'Rider' ?></th>
			<th><?php echo 'Sent To' ?></th>
			<th><select name="quote_status_id" id="quote_designer"
                                            class="form-control input-sm" onchange="selectdesigner(this)">
                                        <?php foreach ($userlist as $user) { ?>
                                            <option value="<?php echo $user->user_id; ?>"
                                                    <?php if ($user->user_id == $quote->responsible_id) { ?>selected="selected"<?php } ?>>
                                                <?php echo $user->user_name; ?>
                                            </option>
                                        <?php } ?>
                                    </select></th>
									<div id="user"></div>
            <th style="text-align: right; padding-right: 25px;"><?php echo lang('amount'); ?></th>
			<th> <input type="checkbox" onchange="checkAll(this)" name="chk[]" id="0"> Check all 
<div class="options btn-group">
                        <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <?php echo lang('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" id="PDF" onclick="downloadfiles();">
                                    <i class="fa fa-print fa-margin"></i> Download selected PDF's
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   onclick="deletequote();">
                                    <i class="fa fa-trash-o fa-margin"></i> <?php echo lang('delete'); ?>
                                </a>
                            </li>
                            <li>
                    <a href="#" id="btn_quotes_to_invoices" data-quote_id="">
                        <i class="fa fa-refresh fa-margin"></i>
                        <?php echo lang('quote_to_invoice'); ?>
                    </a>
                </li>
                        </ul>
                    </div>



 </th>
            <th><?php echo lang('options'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($quotes as $quote) { ?>
            <tr>
                <td>
                    <span
                        class="label <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>"><?php echo $quote_statuses[$quote->quote_status_id]['label']; ?></span>
                </td>
                <td>
                    <a href="<?php echo site_url('quotes/view/' . $quote->quote_id); ?>"
                       title="<?php echo lang('edit'); ?>">
                        <?php echo $quote->quote_number; ?>
                    </a>
                </td>
                <td>
                    <?php echo date_from_mysql($quote->quote_date_created); ?>
                </td>
                <td>
                    <?php echo date_from_mysql($quote->quote_date_expires); ?>
                </td>
                <td>
                     <a href="<?php echo site_url('clients/view/' . $quote->client_id); ?>"
                       title="<?php echo lang('view_client'); ?>">
                        <?php echo $quote->client_name; ?>
                    </a>
					
                </td>

<td>
<?php
if($quote->responsible_id != 0){
	foreach ($userlist as $user){
	if($user->user_id == $quote->responsible_id)
	echo $user->user_id;
	}
}else{
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_field_id'){
				echo $val;
				}
				}
            }
}
          
 ?>
</td> 
				
<td>
<?php
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_rider'){
				echo $val;
				}
				}
            }
        
          
 ?>
</td> 
<td>
<?php
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_sent_to'){
				echo $val;
				}
				}
            }
        
          
 ?>
</td>

<td>
<?php

if($quote->responsible_id != 0){
	foreach ($userlist as $user){
	if($user->user_id == $quote->responsible_id)
	echo $user->user_name;
	}
}else{
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_designer'){
				echo $val;
				}
				}
            }
        
}
 ?>
</td>
				
                <td style="text-align: right; padding-right: 25px;">
                    <?php 
					if($this->session->userdata('user_subtype')!=1){
							echo format_currency($quote->quote_total);
					}
					?>
                </td>
				<td>
                    <input type="checkbox" onchange="add(this)"name="checked" id="<?php echo $quote->quote_id ?>"><br>
                </td>
				
                <td>
                    <div class="options btn-group">
                        <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"
                           href="#">
                            <i class="fa fa-cog"></i> <?php echo lang('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('quotes/view/' . $quote->quote_id); ?>">
                                    <i class="fa fa-edit fa-margin"></i> <?php echo lang('edit'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('quotes/generate_pdf/' . $quote->quote_id); ?>"
                                   target="_blank">
                                    <i class="fa fa-print fa-margin"></i> <?php echo lang('download_pdf'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('mailer/quote/' . $quote->quote_id); ?>">
                                    <i class="fa fa-send fa-margin"></i> <?php echo lang('send_email'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('quotes/delete/' . $quote->quote_id); ?>"
                                   onclick="return confirm('<?php echo lang('delete_quote_warning'); ?>');">
                                    <i class="fa fa-trash-o fa-margin"></i> <?php echo lang('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>