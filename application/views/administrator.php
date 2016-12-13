<!-- gross.  Organized into tables for easy layouts. -->

<div class="span10 offset1">
    <h4>Recipes</h4>
    <table>
        {recipesRow}
        <tr>
            <td>
                {name}
            </td>
            <td>
                {description}&nbsp;
            </td>
            <td>
                <a class='btn btn-danger' role="button" href="/administrator/delete_recipe/{id}/">Delete</a>
            </td>
        </tr>
        {/recipesRow}
    </table>
    <a class="btn btn-default" role="button" href="/administrator/add_recipe/">Add</a>
    <br><br>
    <h4>Stock</h4>
    <table>
        {stockRow}
        <tr>
            <td>
                {name}&nbsp;
            </td>
            <td>
                Price: {price}&nbsp;
            </td>
            <td>
                Quantity: {quantity}&nbsp;&nbsp;
            </td>
            <td>
                <a class="btn btn-default" role="button" href="/administrator/edit_stock/{id}/">Edit</a>
            </td>
        </tr>
        {/stockRow}
    </table>
    <br><br>
    <h4>Supplies</h4>
    <table>
        {suppliesRow}
        <tr>
            <td>
                {name}
            </td>
            <td>
                On hand:{on hand}
            </td>
            <td>
                Containers/shipment: {containerspership}&nbsp;
            </td>
            <td>
                Containers: {containers}&nbsp;
            </td>
            <td>
                Items/container: {itemspercontainer}&nbsp;
            </td>
            <td>
                Cost: {cost}&nbsp;&nbsp;
            </td>
            <td>
                <a class="btn btn-default" role="button" href="/administrator/edit_supply/{id}/">Edit</a>
            </td>
            <td>
            <a class='btn btn-danger' role="button" href="/administrator/delete_supply/{id}/">Delete</a>
        </tr>
        {/suppliesRow}
    </table>
    <a class="btn btn-default" role="button" href="/administrator/add_supply/">Add</a>
    <br><br>
</div>