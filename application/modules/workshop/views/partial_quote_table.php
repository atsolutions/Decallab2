
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
            <th><?php echo 'File link' ?></th>
            <th><?php echo 'Action' ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($quotes as $quote) { ?>
        <?php
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_print_file'){
				$isfile = $val;
				}
				}
            }
            if($isfile != ""){
        
          
 ?>    
            
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
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote->quote_id)->get();
        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();
            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
				if($key == 'quote_custom_print_file'){
				echo '<a href="' . $val . '">' . $val . '</a>';
				}
				}
            }
        
          
 ?>
</td> 
<td>
<?php
    if($quote->quote_status_id == '4'){?>
<button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("workshop/mark_printed/" . $quote->quote_id);?>'">Print</button>
    <?php } elseif($quote->quote_status_id== '10'){?>
<button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("workshop/mark_packed/" . $quote->quote_id);?>'">Pack</button>
    <?php }elseif($quote->quote_status_id== '11'){?>
<button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("workshop/mark_shipped/" . $quote->quote_id);?>'">Ship</button>
    <?php }?>
</td>
            </tr>
            <?php }} ?>
        </tbody>

    </table>
</div>