<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<form method="POST" action="/Administrator/save_supply">
    <p>{error}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>
                    <input class="form-control" name="name" id="supply_name" value="{name}"/>
                </td>
            </tr>
            <tr>
                <td>onHand</td>
                <td>
                    <input class="form-control" name="onHand" type="numeric" id="supply_onHand" value="{onHand}"/>
                </td>
            </tr>
            <tr>
                <td>containersPerShipment</td>
                <td>
                    <input class="form-control" name="containersPerShipment" type="numeric" id="CPS" value="{containersPerShipment}"/>
                </td>
            </tr>
            <tr>
                <td>containers</td>
                <td>
                    <input class="form-control" name="containers" type="numeric" id="containers" value="{containers}"/>
                </td>
            </tr>
            <tr>
                <td>itemsPerContainer</td>
                <td>
                    <input class="form-control" name="itemsPerContainer" type="numeric" id="IPC"  value="{itemsPerContainer}"/>
                </td>
            </tr>
            <tr>
                <td>cost</td>
                <td>
                    <input class="form-control" name="cost" type="numeric" id="cost" value="{cost}"/>
                    <input name="id" type="hidden" value="{id}"/>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" class="btn btn-default btn-danger btn-sm">Save</button>
                    <a class="btn btn-default" role="button" href="/administrator/">Cancel</a>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>