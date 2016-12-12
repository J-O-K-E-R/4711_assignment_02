<style type="text/css">
#left {
  float: left;
  display: block;
}
#right {
  float: right;
  display: block;
}
#row {
  border-bottom: 3px solid black;
}
</style>
<div class="row">
    <div class="span8 offset1">
        <h2>Purchaseable items</h2>
        <form action="/sales/additem" method="POST">
          <div class="row">
            {sales}
            <div id="row">
              <div id="left" class="span5"><b>{name}</b>, {description} for ${price}</div>
              <div id="right"><input type="number" name="{name}" style="width:50%" align="right" value="0" min="0" max="99"></div>
              <br><br><br>
            </div>
            {/sales}
          </div>
          <input type="submit" value="Purchase">
        </form>
    </div>
</div>
