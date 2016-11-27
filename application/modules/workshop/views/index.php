<div id="headerbar">

    <h1><?php echo lang('quotes'); ?></h1>

    <div class="pull-right">
        <button type="button" class="btn btn-default btn-sm submenu-toggle hidden-lg"
                data-toggle="collapse" data-target="#ip-submenu-collapse">
            <i class="fa fa-bars"></i> <?php echo lang('submenu'); ?>
        </button>
        <a class="create-quote btn btn-sm btn-primary" href="#">
            <i class="fa fa-plus"></i> <?php echo lang('new'); ?>
        </a>
    </div>

    <div class="pull-right visible-lg">
        <?php echo pager(site_url('workshop/status/' . $this->uri->segment(3)), 'mdl_quotes'); ?>
    </div>

    <div class="pull-right visible-lg">
        <ul class="nav nav-pills index-options">

            <li <?php if ($status == 'shipped') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/shipped'); ?>"><?php echo 'Shipped'; ?></a></li>
            <li <?php if ($status == 'packed') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/packed'); ?>"><?php echo 'Packed'; ?></a></li>
            <li <?php if ($status == 'approved') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/approved'); ?>"><?php echo lang('approved'); ?></a></li>

        </ul>
    </div>

</div>

<div id="submenu">
    <div class="collapse clearfix" id="ip-submenu-collapse">

        <div class="submenu-row">
            <?php echo pager(site_url('quotes/status/' . $this->uri->segment(3)), 'mdl_quotes'); ?>
        </div>

        <div class="submenu-row">
            <ul class="nav nav-pills index-options">
                <li <?php if ($status == 'shipped') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/shipped'); ?>"><?php echo 'Shipped'; ?></a></li>
            <li <?php if ($status == 'packed') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/packed'); ?>"><?php echo 'Packed'; ?></a></li>
            <li <?php if ($status == 'approved') { ?>class="active"<?php } ?>><a
                    href="<?php echo site_url('workshop/status/approved'); ?>"><?php echo lang('approved'); ?></a></li>
            </ul>
        </div>

    </div>
</div>


<div id="content" class="table-content">

    <div id="filter_results">
        <?php $this->layout->load_view('workshop/partial_quote_table', array('quotes' => $quotes, 'custom_fields'=>$custom)); ?>
    </div>

</div>