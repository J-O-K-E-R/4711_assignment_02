<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">

<form method="POST" action="/Administrator/save_recipe">
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
                <td>Recipe Name</td>
                <td>
                    <input class="form-control" name="name" id="recipe_name"/>
                </td>
            </tr>
            <tr>
                <td>Recipe Price</td>
                <td>
                    <input class="form-control" name="price" id="recipe_price"/>
                </td>
            </tr>
            <br><br>
            {supplies}
            <tr>
                <td>Number of: {name}s</td>
                <td>
                    <input class="form-control" name="{id}" type="numeric" value="0" id="ingredients"/>
                </td>
            </tr>
            {/supplies}
            <tr>
                <td>
                    <button type="submit" class="btn btn-default btn-danger btn-sm">Save</button>
                    <a class="btn btn-default" role="button" href="/administrator/">Cancel</a>
                </td>
                <td></td>
                <input name="id" type="hidden" value="{id}"/>
            </tr>
        </tbody>
    </table>
</form>
