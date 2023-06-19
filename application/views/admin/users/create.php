<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/users/create'); ?>

    <label for="name">Name</label>
    <input type="text" name="name" /><br />

    <label for="email">Email</label>
    <input type="email" name="email" /><br />

    <label for="phone">Phone</label>
    <input type="text" name="phone" /><br />

    <input type="submit" name="submit" value="Create user" />

</form>