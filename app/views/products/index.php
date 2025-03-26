<h2>List of products</h2>

<?php // if($userModel->hasPermission('create_product')): ?>
    <a href="/product/create">Create New User</a>
<?php // endif; ?>

<table>
    <th>
    <td>ID</td>
    <td>Title</td>
    <td>Brand</td>
    <td>Model</td>
    <td>Price</td>
    <td>Quantity</td>
    </th>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->title ?></td>
                <td><?= $product->brand ?></td>
                <td><?= $product->model ?></td>
                <td><?= $product->price ?></td>
                <td><?= $product->quantity ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>