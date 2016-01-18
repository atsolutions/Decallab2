<div id="headerbar">
    <h1><?php echo lang('quote'); ?> #<?php echo $quote->quote_number; ?></h1>

    <div class="pull-right btn-group">

        <?php if (in_array($quote->quote_status_id, array(2, 3))) { ?>
            <a href="<?php echo site_url('guest/quotes/approve/' . $quote->quote_id); ?>"
               class="btn btn-success btn-sm">
                <i class="fa fa-check"></i>
                <?php echo lang('approve_this_quote'); ?>
            </a>
            <a href="<?php echo site_url('guest/quotes/reject/' . $quote->quote_id); ?>"
               class="btn btn-danger btn-sm">
                <i class="fa fa-times-circle"></i>
                <?php echo lang('reject_this_quote'); ?>
            </a>
        <?php } elseif ($quote->quote_status_id == 4) { ?>
            <a href="#" class="btn btn-success btn-sm disabled">
                <i class="fa fa-check"></i>
                <?php echo lang('quote_approved'); ?>
            </a>
        <?php } elseif ($quote->quote_status_id == 5) { ?>
            <a href="#" class="btn btn-danger btn-sm disabled">
                <i class="fa fa-times-circle"></i>
                <?php echo lang('quote_rejected'); ?>
            </a>
        <?php } ?>

        <a href="<?php echo site_url('guest/quotes/generate_pdf/' . $quote_id); ?>"
           class="btn btn-default btn-sm" id="btn_generate_pdf">
            <i class="fa fa-print"></i> <?php echo lang('download_pdf'); ?>
        </a>
    </div>

</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<div id="content">

    <div class="quote">

        <div class="row">

            <div class="col-xs-12 col-md-9">

                <h2><?php echo $quote->client_name; ?></h2><br>
                <span>
                    <?php echo ($quote->client_address_1) ? $quote->client_address_1 . '<br>' : ''; ?>
                    <?php echo ($quote->client_address_2) ? $quote->client_address_2 . '<br>' : ''; ?>
                    <?php echo ($quote->client_city) ? $quote->client_city : ''; ?>
                    <?php echo ($quote->client_state) ? $quote->client_state : ''; ?>
                    <?php echo ($quote->client_zip) ? $quote->client_zip : ''; ?>
                    <?php echo ($quote->client_country) ? '<br>' . $quote->client_country : ''; ?>
                </span>
                <br><br>
                <?php if ($quote->client_phone) { ?>
                    <span><strong><?php echo lang('phone'); ?>:</strong> <?php echo $quote->client_phone; ?></span><br>
                <?php } ?>
                <?php if ($quote->client_email) { ?>
                    <span><strong><?php echo lang('email'); ?>:</strong> <?php echo $quote->client_email; ?></span>
                <?php } ?>

            </div>

            <div class="col-xs-12 col-md-3">
                <div class="panel panel-default panel-body text-right">
                    <table class="table table-condensed">
                        <tr>
                            <td><?php echo lang('quote'); ?> #</td>
                            <td><?php echo $quote->quote_number; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date_from_mysql($quote->quote_date_created); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('due_date'); ?></td>
                            <td><?php echo date_from_mysql($quote->quote_date_expires); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <br/>
        <div class="table-responsive">
            <table id="item_table" class="items table table-striped table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th><?php echo lang('item'); ?> / <?php echo lang('description'); ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <?php
                $i = 1;
                foreach ($items as $item) { ?>
                    <tbody>
                    <tr>
                        <td rowspan="2" style="max-width: 20px;" class="text-center">
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?php echo $item->item_name; ?></td>
                        <td>
                            <span class="pull-left"><?php echo lang('quantity'); ?></span>
                            <span class="pull-right amount"><?php echo $item->item_quantity; ?></span>
                        </td>
                        <td>
                            <span class="pull-left"><?php echo lang('discount'); ?></span>
                            <span class="pull-right amount"><?php echo format_currency($item->item_discount); ?></span>
                        </td>
                        <td>
                            <span class="pull-left"><?php echo lang('subtotal'); ?></span>
                            <span class="pull-right amount"><?php echo format_currency($item->item_subtotal); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted"><?php echo $item->item_description; ?></td>
                        <td>
                            <span class="pull-left"><?php echo lang('price'); ?></span>
                            <span class="pull-right amount"><?php format_amount($item->item_price); ?></span>
                        </td>
                        <td>
                            <span class="pull-left"><?php echo lang('tax'); ?></span>
                            <span class="pull-right amount"><?php echo format_amount($item->item_tax_total); ?></span>
                        </td>
                        <td>
                            <span class="pull-left"><?php echo lang('total'); ?></span>
                            <span class="pull-right amount"><?php echo format_currency($item->item_total); ?></span>
                        </td>
                    </tr>
                    </tbody>
                <?php } ?>

            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-right"><?php echo lang('subtotal'); ?></th>
                    <th class="text-right"><?php echo lang('item_tax'); ?></th>
                    <th class="text-right"><?php echo lang('quote_tax'); ?></th>
                    <th class="text-right"><?php echo lang('discount'); ?></th>
                    <th class="text-right"><?php echo lang('total'); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="amount"><?php echo format_currency($quote->quote_item_subtotal); ?></td>
                    <td class="amount"><?php echo format_currency($quote->quote_item_tax_total); ?></td>
                    <td class="amount">
                        <?php if ($quote_tax_rates) {
                            foreach ($quote_tax_rates as $quote_tax_rate) { ?>
                                <?php echo $quote_tax_rate->quote_tax_rate_name . ' ' . $quote_tax_rate->quote_tax_rate_percent; ?>%:
                                <?php echo format_currency($quote_tax_rate->quote_tax_rate_amount); ?><br/>
                            <?php }
                        } else {
                            echo format_currency('0');
                        } ?>
                    </td>
                    <td class="amount"><?php
                        if ($quote->quote_discount_percent == floatval(0)) {
                            echo $quote->quote_discount_percent.'%';
                        } else {
                            echo format_currency($quote->quote_discount_amount);
                        }
                        ?>
                    </td>
                    <td class="amount"><b><?php echo format_currency($quote->quote_total); ?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
		
		<div class="row">
            <div class="col-xs-12 col-sm-4">

                <div class="form-group">
                    <label class="control-label"><?php echo lang('notes'); ?></label>
                    <textarea name="notes" id="notes" rows="3"
                              class="input-sm form-control"><?php echo $quote->notes; ?></textarea>
                </div>

            </div>
            <div class="col-xs-12 col-sm-8">

                <div class="form-group">
                    <label class="control-label"><?php echo lang('attachments'); ?></label>
                    <br/>
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-default fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span><?php echo lang('add_files'); ?></span>
                    </span>
                </div>
                <!-- dropzone -->
                <div id="actions" class="col-xs-12 col-sm-12 row">
                    <div class="col-lg-7">
                    </div>
                    <div class="col-lg-5">
                        <!-- The global file processing state -->
                    <span class="fileupload-process">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar"
                             aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                 data-dz-uploadprogress></div>
                        </div>
                    </span>
                    </div>

                    <div class="table table-striped" class="files" id="previews">

                        <div id="template" class="file-row">
                            <!-- This is used as the file preview template -->
                            <div>
                                <span class="preview"><img data-dz-thumbnail/></span>
                            </div>
                            <div>
                                <p class="name" data-dz-name></p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <div>
                                <p class="size" data-dz-size></p>

                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="..."
                                         data-dz-uploadprogress></div>
                                </div>
                            </div>
                            <div>
                                <button data-dz-remove class="btn btn-danger btn-sm delete">
                                    <i class="fa fa-trash-o"></i>
                                    <span><?php echo lang('delete'); ?></span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- stop dropzone -->

            </div>
        </div>
		
    </div>

</div>