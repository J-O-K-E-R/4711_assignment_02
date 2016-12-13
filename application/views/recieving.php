<div class="row">
    <div class="span8 offset1">
        <h2>Supplies to recieve</h2>
        <form method="POST" action="/Recieving/recieve">
            <div class="row">
              	{supplies}
              	<div id="row">
                	<div id="left" class="span4">
                		<b>{name} x{items per container}:</b>
                	</div>
                	<div id="right">
                		<input type="number" name="{id}" value="0" min="0" max="99">
                	</div>
                	<br><br><br>
             	</div>
              	{/supplies}
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
