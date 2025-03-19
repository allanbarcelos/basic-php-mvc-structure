<h2>List of Users</h2>

<?php if($userModel->hasPermission('create_user')): ?>
    <a href="/user/create">Create New User</a>
<?php endif; ?>

<table>
    <th>
    <td>ID</td>
    <td>Name</td>
    <td>Email</td>
    </th>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->name ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>