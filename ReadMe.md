```
RoadSimba
    |
    | --- index.php (//home page)
    | --- registration.php (//email, password, firstname, lastname, phone, role)
    | --- search.php (#todo)
    | --- db
            | --- users
            | --- loads
            | --- vehicles
            | --- orders
            | --- dispcarr (// dispatchers and carriers)
    | --- css
            | --- // Bootstrap
    | --- js
            | --- // Bootstrap
    | --- fonts
    | --- includes
            |
            | --- config.php (//connect to database)
            | --- login.php
            | --- logout.php
            | --- header.php
            | --- footer.php
            | --- navigation.php
            | --- widget.php (#todo)
            | --- sidebar.php 
                        | --- login form
                        | --- search box (#todo)
    | --- admin
            |
            | --- index.php (//CMS)   
            | --- fleets.php (// router for fleets)
            | --- dispatchers.php (// router for dispatchers)
            | --- functions.php (// helper functions)
            | --- loads.php (// router for loads)
            | --- profile.php (#todo) 
            | --- css
            | --- js
            | --- fonts
            | --- includes 
                        |
                        | --- add_dispatcher.php (@dispatchers.php?source=add_dispatcher)
                        | --- edit_dispatcher.php (@dispatchers.php?source=edit_dispatcher&user_ID=$user_id)
                        | --- all_dispatchers.php (default)
                        | --- add_fleet.php (@fleets.php?source=add_fleet)
                        | --- edit_fleet.php (@fleets.php?source=edit_fleet&user_ID=$user_id)
                        | --- all _fleets.php (default)
                        | --- add_load.php (@loads.php?source=add_load)
                        | --- edit_loads.php (@loads.php?source=edit_load&load_ID=$load_id)
                        | --- all_loads.php (default)
                        | --- header.php
                        | --- footer.php
                        | --- navigation.php
```