<h1>Orders Processed So Far</h1>
<div class=table-responsive>
    <table class="table">
        <tr><th>Order #</th><th>Date/time</th><th>Amount</th></tr>
        {orders}
        <tr>
            <td><a href="/sales/examine/{number}">{number}</a></td>
            <td>{datetime}</td>
            <td>{total}</td>
        </tr>
        {/orders}
    </table>
</div>
<a class="btn btn-default" role="button" href="/sales/neworder">Start a New Order</a>
