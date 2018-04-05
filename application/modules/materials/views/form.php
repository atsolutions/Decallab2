<form method="post" class="form-horizontal">

    <div id="headerbar">
        <h1><?php echo 'Materials form'; ?></h1>
        <?php $this->layout->load_view('layout/header_buttons'); ?>
    </div>

    <div id="content">

        <?php $this->layout->load_view('layout/alerts'); ?>

        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <fieldset>
                    <legend>
                        <?php if ($this->mdl_materials->form_value('material_id')) : ?>
                            #<?php echo $this->mdl_materials->form_value('material_id'); ?>&nbsp;
                            <?php echo $this->mdl_materials->form_value('material_name'); ?>
                        <?php else : ?>
                            <?php echo 'New material'; ?>
                        <?php endif; ?>
                    </legend>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 col-lg-2 text-right text-left-xs">
                            <label class="control-label"><?php echo 'Material name'; ?>: </label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-8">
                            <input type="text" name="material_name" id="material_name" class="form-control"
                                   value="<?php echo $this->mdl_materials->form_value('material_name'); ?>">
                        </div>
                                             
                                             
                                             
                    </div>       
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-3 col-lg-2 text-right text-left-xs">
                            <label class="control-label"><?php echo 'Material description'; ?>: </label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-8">
                            <textarea name="material_description" id="material_description" class="form-control"
                                      rows="3"><?php echo $this->mdl_materials->form_value('material_description'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 col-lg-2 text-right text-left-xs">
                            <label class="control-label"><?php echo 'Material price'; ?>: </label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-8">
                            <input type="text" name="material_price" id="material_price" class="form-control"
                                   value="<?php echo format_amount($this->mdl_materials->form_value('material_price')); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 col-lg-2 text-right text-left-xs">
                            <label class="control-label"><?php echo 'Material quantity'; ?>: </label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-8">
                            <input type="text" name="material_quantity" id="material_quantity" class="form-control"
                                   value="<?php echo $this->mdl_materials->form_value('material_quantity'); ?>">
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>

    </div>

</form>