<div id="headerbar">
    <h1>
        <?php echo 'Create new Issue'; ?>
    </h1>
</div>

 

<div id="content">
<?php $this->layout->load_view('layout/alerts'); ?>
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
                    <label for="title_text">
                        <?php echo 'Title'; ?>
                    </label>

                            <textarea  name="title_text" id="title_text" class="form-control" rows="1"></textarea>
                </div>
                
                
                <div class="form-group has-feedback">
                    <label for="body_text">
                        <?php echo 'Description'; ?>
                    </label>
                    <textarea name="body_text" id="body_text" class="form-control" rows="5"></textarea>
                </div>


                <input type="submit" class="btn btn-success" name="btn_submit"
                       value="<?php echo 'Submit Issue'; ?>">

            </form>

        </div>

    </div>
     <div id="report_options" class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-print"></i>
                <?php echo 'Current issues'; ?>
            </h3>
        </div>
    <?php foreach ($issues as $issue) : ?>
    <ul class="list-group">
        <li class="list-group-item">
            <strong><h4 class="list-group-item-heading"><?php echo $issue->title; ?> </strong>&nbsp;
        <p>
	<?php echo nl2br($issue->body); ?>
        </p>
        </li>
    </ul>
    

<?php endforeach; ?>
     </div>
    
    
    
    
    
    

</div>
