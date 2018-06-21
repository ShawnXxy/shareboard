<!-- Side Widget Well -->

<?php
    include "config.php";
    // include "./admin/functions.php"

?>

<div class="well">
    <h4>Content</h4>
    <?php

        $sql = "SELECT * FROM $table_posts ORDER BY post_date DESC;";
        $query =  mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];

            echo "<p>";
            echo "$post_date<br/>";
            echo "<a href='../post.php?post_id=$post_id' target='_blank'>$post_title</a>";
            echo "</p>";
        }
    ?>
</div>
