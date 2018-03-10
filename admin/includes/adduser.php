
<form action="" method="post" enctype="multipart/form-data">
    <!-- Insert post -->
    <?php add_user(); ?>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_img">Upload Your Profile Picture</label>
        <input type="file" name="user_img">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_user" value="Create">
    </div>
</form>