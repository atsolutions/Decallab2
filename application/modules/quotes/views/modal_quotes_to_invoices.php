<script type="text/javascript">
    $(function () {
        // Display the create quote modal
        $('#modal_quote_to_invoice').modal('show');

        // Creates the invoice
        $('#quote_to_invoice_confirm').click(function () {
            $.post("<?php echo site_url('quotes/ajax/quotes_to_invoices'); ?>", {
                    quote_id: <?php echo $quote_id; ?>,
                    string_list: $('#string_list').val(),	
                    client_name: $('#client_name').val(),
                    invoice_date_created: $('#invoice_date_created').val(),
                    invoice_group_id: $('#invoice_group_id').val(),
		    currency: $('#currency').val(),
                    shipping_amount: $('#invoice_shipping_amount').val(),
                    invoice_password: $('#invoice_password').val(),
                    user_id: $('#user_id').val()
            
                },
                function (data) {
                    var response = JSON.parse(data);
                    if (response.success == '1') {		
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
		
    });

</script>







<div id="modal_quote_to_invoice" class="modal col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"
     role="dialog" aria-labelledby="modal_quote_to_invoice" aria-hidden="true">
    <form class="modal-content">
        <div class="modal-header">
            <a data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>

            <h3><?php echo 'Quotes To Invoice '; ?></h3>
        </div>
        <div class="modal-body">

          
            <input type="hidden" name="currency" id="currency"
                   value="<?php echo $quote->quote_currency; ?>">
            <input type="hidden" name="user_id" id="user_id"
                   value="<?php echo $quote->user_id; ?>">

            <input type="hidden" name="string_list" id="string_list"
                   value="<?php echo $string_list; ?>">

           
            
            <div class="form-group">
                
                <h3><?php echo 'You will merge the following quotes: '; ?></h3>
            
  <?php
  //Create different partial view!
  $this->layout->load_view('quotes/partial_quote_table', array('quotes' => $quote_list));
  ?>
          
           <div class="form-group">
                <label for="invoice_shipping_amount"><?php echo 'Shipping'; ?></label>
                <input type="text" name="invoice_shipping_amount" id="invoice_shipping_amount" class="form-control"
                       value="" style="margin: 0 auto;" autocomplete="off">
            </div>
            
                
                
                
       <label for="invoice_group_id">
                    <?php echo 'Client name'; ?>
                </label>         
                
<select name="client_name" id="client_name"
          class="form-control input-sm">
            <?php foreach ($clientlist as $client) { ?>
             <option value="<?php echo $client->client_name; ?>">
             <?php echo $client->client_name; ?>
             </option>
             <?php } ?>
</select>
            </div>

            <div class="form-group has-feedback">
                <label for="invoice_date_created">
                    <?php echo lang('invoice_date'); ?>
					
                </label>

                <div class="input-group">
                    <input name="invoice_date_created" id="invoice_date_created"
                           class="form-control datepicker" value="<?php echo date("d-m-Y"); ?>">
						<span class="input-group-addon">
								<i class="fa fa-calendar fa-fw"></i>
						</span>
                </div>
            </div>

            <div class="form-group">
                <label for="invoice_password"><?php echo lang('invoice_password'); ?></label>
                <input type="text" name="invoice_password" id="invoice_password" class="form-control"
                       value="<?php if ($this->mdl_settings->setting('invoice_pre_password') == '') {
                           echo '';
                       } else {
                           echo $this->mdl_settings->setting('invoice_pre_password');
                       } ?>" style="margin: 0 auto;" autocomplete="off">
            </div>
            
            
            
            

            <div class="form-group">
                <label for="invoice_group_id">
                    <?php echo lang('invoice_group'); ?>
                </label>
                <select name="invoice_group_id" id="invoice_group_id" class="form-control">
                    <option value=""></option>
                    <?php foreach ($invoice_groups as $invoice_group) { ?>
                        <option value="<?php echo $invoice_group->invoice_group_id; ?>"
                                <?php if ($this->mdl_settings->setting('default_invoice_group') == $invoice_group->invoice_group_id) { ?>selected="selected"<?php } ?>>
                            <?php echo $invoice_group->invoice_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>


        
        
        
        <div class="modal-footer">
            <div class="btn-group">
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-times"></i> <?php echo lang('cancel'); ?>
                </button>
                <button class="btn btn-success" id="quote_to_invoice_confirm" type="button">
                    <i class="fa fa-check"></i> <?php echo lang('submit'); ?>
                </button>
            </div>
        </div>

    </form>

</div>
