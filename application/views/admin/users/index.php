<h2>Users</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td>
                    <a href="<?php echo site_url('admin/users/edit/'.$user['id']); ?>">Edit</a>
                    <a href="<?php echo site_url('admin/users/delete/'.$user['id']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo site_url('admin/users/create'); ?>">Create a new user</a>