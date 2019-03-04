<!-- Side Widget Well -->

<?php
    include "config.php";
    // include "./admin/functions.php"

?>

<div class="well">
    <h4>Content</h4>
    <?php

        $sql = "SELECT post_id, post_title, post_date, post_tags FROM $table_posts where post_type = 1 ORDER BY post_date DESC;";
        $query =  mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_tags = $row['post_tags'];

            echo "<p>";
            echo "$post_date<br/>";
            echo "<a href='../shareboard/post.php?post_id=$post_id' target='_blank'> [$post_tags] $post_title</a>";
            echo "</p>";
        }
    ?>
</div>
