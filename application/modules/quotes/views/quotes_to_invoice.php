<p>You are going to merge these quotes into one invoice</p>

<p>Select client to invoice: </p>
 
<select name="client_name" id="client_name"
          class="form-control input-sm">
            <?php foreach ($clientlist as $client) { ?>
             <option value="<?php echo $client->client_id; ?>">
             <?php echo $client->client_name; ?>
             </option>
             <?php } ?>
</select>

            <div class="form-group">
                <label><?php echo lang('invoice_group'); ?></label>

                <div class="controls">
                    <select name="invoice_group_id" id="invoice_group_id" class="form-control">
                        <option value=""></option>
                            <option value="1"</option>
                    </select>
                </div>
            </div>




 <?php 
 $this->layout->load_view('quotes/partial_quote_table', array('quotes' => $quote_list));
 
 print_r($amounts);
 print_r($items);
 ?>


<button id="btn-submit" name="btn_submit_quotes_to_invoice" class="btn btn-success btn-sm ajax-loader" value="1">
        <i class="fa fa-check"></i> <?php echo 'Submit'; ?>
    </button>
 <button id="btn-cancel" name="btn_cancel" class="btn btn-danger btn-sm" value="1">
        <i class="fa fa-times"></i> <?php echo lang('cancel'); ?>
    </button>


<script>
            $('#btn_submit_quotes_to_invoice').click(function () {
            // Posts the data to validate and create the invoice;
            // will create the new client if necessar
            $.post("<?php echo site_url('invoices/ajax/create'); ?>", {
                    client_name: $('#client_name').val(),
                    invoice_date_created: '<?php echo date('Y-m-d')?>',
                    invoice_group_id: $('#invoice_group_id').val(),
                    invoice_time_created: '<?php echo date('H:i:s') ?>',
                    invoice_password: $('#invoice_password').val(),
                    user_id: '<?php echo $this->session->userdata('user_id'); ?>'
                   
                },
                function (data) {
                    var response = JSON.parse(data);
                    if (response.success == '1') {
                        // The validation was successful and invoice was created
                        window.location = "<?php echo site_url('invoices/view'); ?>/" + response.invoice_id;
                    }
                    else {
                        // The validation was not successful
                        $('.control-group').removeClass('has-error');
                        for (var key in response.validation_errors) {
                            $('#' + key).parent().parent().addClass('has-error');
                        }
                    }
                });
        });
    
    
    
    
    </script>
    
 
 
 
 
									
