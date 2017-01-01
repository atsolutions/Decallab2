<div id="headerbar">
    <h1><?php echo 'Create new Issue'; ?></h1>
</div>

<div id="content">

    <div id="report_options" class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-print"></i>
                <?php echo 'Create new Issue'; ?>
            </h3>
        </div>

        <div class="panel-body">

            <form method="post"
                  action="<?php echo site_url($this->uri->uri_string()); ?>">

                 <div class="form-group has-feedback">
                    <label for="body_text">
                        <?php echo 'Title'; ?>
                    </label>

                    <input type="hidden" name="quote_id" id="quote_id"
                                   value="<?php echo $quote->quote_id; ?>">
                            <textarea id="quote_note" class="form-control" rows="5"></textarea>
                </div>
                
                
                <div class="form-group has-feedback">
                    <label for="body_text">
                        <?php echo 'Description'; ?>
                    </label>

                    <input type="hidden" name="quote_id" id="quote_id"
                                   value="<?php echo $quote->quote_id; ?>">
                            <textarea id="quote_note" class="form-control" rows="5"></textarea>
                </div>


                <input type="submit" class="btn btn-success" name="btn_submit"
                       value="<?php echo 'Submit Issue'; ?>">

            </form>

        </div>

    </div>

</div>
