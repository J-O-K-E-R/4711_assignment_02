<h2>Thank you for your purchase.</h2>
<br>
<br>


<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Receipt</h3>
    </div>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
            
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>SubTotals</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        
            <tr>
            {order}
                <td>{name}</td>
                <td>{quantity}</td>
                <td>${price}</td> 
                <td>${subtotal}</td>
            {/order}
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>${totalcost}</td>
            </tr>
        
        </tbody>
    </table>
    <div>
    </div>
    <div class="w3-third w3-center">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Your Cart</h3>
            </div>
            <div class="panel-body">
                {receipt}
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</div>