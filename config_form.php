<?php
$db = get_db();

?>


<div class="field">
	<label for="per_page">Number of Questions per Item</label>
	<div class="inputs">
	<input type="text" class="textinput"  name="per_page" size="4" value="<?php echo get_option('focusq_per_page'); ?>" id="per_page" />
	<p class="explanation">The number of questions available per item. No max, recommended 5 or less. </p>
	</div>
</div>
