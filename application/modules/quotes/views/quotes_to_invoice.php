You are going to merge these quotes into one invoice

 <?php 
 $this->layout->load_view('quotes/partial_quote_table', array('quotes' => $quote_list));
 

 ?>
 
 Select client to invoice: 
 
<select name="quote_status_id" id="quote_designer"
                                            class="form-control input-sm">
                                        <?php foreach ($clientlist as $client) { ?>
                                            <option value="<?php echo $client->client_id; ?>">
                                                <?php echo $client->client_name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
									
