<div class="row">
    <div class="span8 offset1">
        <h2>Purchaseable items</h2>
        <form method="POST" action="/Sales/sell">
	         <div class="row">
	            {sales}
	            <div id="row">
	              	<div id="left" class="span5">
	              		<b>{name}</b>
	              		, {description} for ${price}
	              	</div>
	              	<div id="right">
	              		<input type="number" name="{id}" align="right" value="0" min="0" max="99">
	              	</div>
	              	<br><br><br>
	            </div>
	            {/sales}
	        </div>
	        <input type="submit" value="Submit">
        </form>
    </div>
</div>
