
<form action="" method="post" enctype="multipart/form-data">
    <!-- Insert post -->
    <?php insert_post(); ?>
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>

    <div class="form-group">
        <label for="post_cat">Category</label>
        <select name="post_cat_id" id="">
            <?php
                $sql = "SELECT * FROM $table_cat;";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $_SESSION['username']; ?>" disabled="true">
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

        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="50"></textarea>
        <script type="text/javascript">
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                });
        </script>

        <!-- CKeditor5 Document style -->
        <!-- <div class="" id="toolbar-container"></div>
        <div name="post_content" class="form-control" id="editor" cols="30" rows="20" style="height:500px; display:flex; flex-flow:column nowrap; overflow:auto;">
        </ >
        <script>
            DecoupledEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    const toolbarContainer = document.querySelector( '#toolbar-container' );

                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script> -->
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="publish_post" value="Publish">
    </div>
</form>
