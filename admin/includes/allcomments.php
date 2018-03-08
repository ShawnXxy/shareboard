<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Posts data loading here -->
        <?php load_comments(); ?>
    </tbody>
</table>

<?php delete_comment(); ?>
    