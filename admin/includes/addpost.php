
<form action="" method="post" enctype="multipart/form-data">
    <!-- Insert post -->
    <?php insert_post(); ?>
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>

    <div class="form-group">
        <label for="post_cat_id">Post Category</label>
        <input type="text" class="form-control" name="post_cat_id">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" required>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="publish_post" value="Publish">
    </div>
</form>