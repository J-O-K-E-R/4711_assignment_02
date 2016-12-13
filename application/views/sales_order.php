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
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        
            <tr>
            {order}
                <td>{name}</td>
                <td>{quantity}</td>
                <td>{price}</td>
                {/order}
            </tr>
        
        </tbody>
    </table>
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
                <a class="btn btn-default btn-primary" role="button" href="/sales/checkout">Checkout</a>
                <a class="btn btn-default" role="button" href="/sales/cancel">Cancel Order</a> 
            </div>
        </div>
    </div> 
</div>