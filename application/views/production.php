<div class="row">
    <div class="span8 offset1">
        <h2>Recipes</h2>
        <form method="POST" action="/Production/produce">
          	<div class="row">
            	{recipes}
            	<div id="row">
	              	<div id="left" class="span4">
		              	<b>{name}</b>
		              	: {description}
	              	</div>
	              	<div id="right">
	              		<input type="number" name="{id}" align="right" value="0" min="0" max="99">
	              	</div>
	              	<br><br><br>
            	</div>
            	{/recipes}
          	</div>
          	<input type="submit" value="Submit">
        </form>
    </div>
</div>
