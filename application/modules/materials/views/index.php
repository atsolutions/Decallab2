<div id="headerbar">
    <h1><?php echo 'Materials'; ?></h1>

    <div class="pull-right">
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('materials/form'); ?>"><i
                class="fa fa-plus"></i> <?php echo lang('new'); ?></a>
    </div>

    <div class="pull-right">
        <?php echo pager(site_url('materials/index'), 'mdl_materials'); ?>
    </div>

</div>

<div id="content" class="table-content">

    <?php $this->layout->load_view('layout/alerts'); ?>

    <div class="table-responsive">
        <table class="table table-striped">

            <thead>
            <tr>
                <th><?php echo 'Material name'; ?></th>
                <th><?php echo 'Material description'; ?></th>
                <th><?php echo 'Material price'; ?></th>
                <th><?php echo 'Material quantity'; ?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($materials as $material) { ?>
                <tr>
                    <td><?php echo $material->material_name; ?></td>
                    <td><?php echo nl2br($material->material_description); ?></td>
                    <td><?php echo $material->material_price; ?></td>
                    <td><?php echo $material->material_quantity; ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>