<h2>Thank you for your purchase.</h2>
<br>
<br>


<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Receipt</h3>
    </div>
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
                <td>{name}</td>
                <td>{quantity}</td>
                <td>{price}</td>
                <td><?php echo $price * $quantity; ?></td>
            </tr>
        </tbody>
    </table>
</div>