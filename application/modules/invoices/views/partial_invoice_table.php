<script>
var Checked = new Array()
var clickedonPDF = document.getElementById("PDF");
clickedonPDF.onclick = downloadfiles()
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
				 add(checkboxes[i])
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
				 add(checkboxes[i])
             }
         }
     }
 }
 

 
 function add(ele){
	 if(ele.checked){
		 if(ele.id != 0){
		 Checked.push(ele.id)
		 }
	 }else{
		 var index = Checked.indexOf(ele.id)
		 if(index >-1){
		 Checked.splice(index,1)
		 }
	 }
document.getElementById("demo").innerHTML = Checked;
 }
 

function downloadfiles(){
	var origin = document.location.origin
	var url = origin.concat("/Decallab/invoices/generate_pdf/")
	for (var i = 0; i < Checked.length; i++) {
		var url2 = url.concat(Checked[i])
		window.open(url2, "_blank")
	}
}

function deletequote(){
	var origin = document.location.origin
	var url = origin.concat("/Decallab/invoices/delete/")
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


</script>


<div class="table-responsive">
    <table class="table table-striped">

        <thead>
        <tr>
            <th><?php echo lang('status'); ?></th>
            <th><?php echo lang('invoice'); ?></th>
            <th><?php echo lang('created'); ?></th>
            <th><?php echo lang('due_date'); ?></th>
            <th><?php echo lang('client_name'); ?></th>
            <th style="text-align: right;"><?php echo lang('amount'); ?></th>
            <th style="text-align: right;"><?php echo lang('balance'); ?></th>
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
                        </ul>
                    </div>			
			
			
            <th><?php echo lang('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($invoices as $invoice) {
            if ($this->config->item('disable_read_only') == TRUE) {
                $invoice->is_read_only = 0;
            }
            ?>
            <tr>
                <td>
                    <span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label'];
                        if ($invoice->invoice_sign == '-1') { ?>
                            &nbsp;<i class="fa fa-credit-invoice"
                                     title="<?php echo lang('credit_invoice') ?>"></i>
                        <?php }
                        if ($invoice->is_read_only == 1) { ?>
                            &nbsp;<i class="fa fa-read-only"
                                     title="<?php echo lang('read_only') ?>"></i>
                        <?php }; ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>"
                       title="<?php echo lang('edit'); ?>">
                        <?php echo $invoice->invoice_number; ?>
                    </a>
                </td>

                <td>
                    <?php echo date_from_mysql($invoice->invoice_date_created); ?>
                </td>

                <td>
                    <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('clients/view/' . $invoice->client_id); ?>"
                       title="<?php echo lang('view_client'); ?>">
                        <?php echo $invoice->client_name; ?>
                    </a>
                </td>

                <td class="amount <?php if ($invoice->invoice_sign == '-1') {
                    echo 'text-danger';
                }; ?>">
                    <?php echo format_currency($invoice->invoice_total); ?>
                </td>

                <td class="amount">
                    <?php echo format_currency($invoice->invoice_balance); ?>
                </td>
				
								<td>
                    <input type="checkbox" onchange="add(this)"name="checked" id="<?php echo $invoice->invoice_id ?>"><br>
                </td>

                <td>
                    <div class="options btn-group">
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <?php echo lang('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($invoice->is_read_only != 1) { ?>
                                <li>
                                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>">
                                        <i class="fa fa-edit fa-margin"></i> <?php echo lang('edit'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                   target="_blank">
                                    <i class="fa fa-print fa-margin"></i> <?php echo lang('download_pdf'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('mailer/invoice/' . $invoice->invoice_id); ?>">
                                    <i class="fa fa-send fa-margin"></i> <?php echo lang('send_email'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="invoice-add-payment"
                                   data-invoice-id="<?php echo $invoice->invoice_id; ?>"
                                   data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"
                                   data-invoice-payment-method="<?php echo $invoice->payment_method; ?>">
                                    <i class="fa fa-money fa-margin"></i>
                                    <?php echo lang('enter_payment'); ?>
                                </a>
                            </li>
                            <?php if ($invoice->invoice_status_id == 1 || ($this->config->item('enable_invoice_deletion') === TRUE && $invoice->is_read_only != 1)) { ?>
                                <li>
                                    <a href="<?php echo site_url('invoices/delete/' . $invoice->invoice_id); ?>"
                                       onclick="return confirm('<?php echo lang('delete_invoice_warning'); ?>');">
                                        <i class="fa fa-trash-o fa-margin"></i> <?php echo lang('delete'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>