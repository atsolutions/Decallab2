<div div id="" style="overflow-y:scroll; height:200px;">
<nav>
<ul>
<?php foreach ($quote_notes as $quote_note) : ?>
    <li><div class="alert alert-default">
        <i> <?php echo $quote_note->note_author; ?></i>
        <strong><?php echo $quote_note->note_date; ?></strong>&nbsp;
        <p>
	<?php echo nl2br($quote_note->note); ?>
        </p>
    </div>
    </li>

<?php endforeach; ?>
</ul>
</nav>
</div>
