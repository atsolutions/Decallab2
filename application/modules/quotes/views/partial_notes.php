<?php foreach ($quote_notes_notes as $quote_note) : ?>
    <div class="alert alert-default">
        <p><strong><?php echo date_from_mysql($quote_note->note_date, TRUE); ?></strong>&nbsp;
            <?php echo $quote_note->note_author; ?>
			<?php echo nl2br($quote_note->note); ?>
        </p>
    </div>
<?php endforeach; ?>