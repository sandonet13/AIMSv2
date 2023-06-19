<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/edit/'.$user['id']); ?>

    <label for="name">Name</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" /><br />

    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" /><br />

    <label for="phone">Phone</label>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>" /><br />

    <input type="submit" name="submit" value="Update user" />

</form>
