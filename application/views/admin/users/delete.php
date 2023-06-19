<h2>Delete user</h2>

<p>Are you sure you want to delete this user?</p>

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Phone: <?php echo $user['phone']; ?></p>
<?php echo form_open('admin/users/delete/'.$user['id']); ?>
<input type="submit" name="submit" value="Yes" />
<a href="<?php echo site_url('users'); ?>">No</a>
</form>