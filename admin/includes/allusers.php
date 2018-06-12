<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Profile Picture</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <!-- <th>Role</th> -->
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Users data loading here -->
        <?php load_users(); ?>
    </tbody>
</table>

<?php delete_user(); ?>
    