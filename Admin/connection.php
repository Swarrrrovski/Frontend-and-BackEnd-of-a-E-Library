<?php

	$db =mysqli_connect("localhost","root","","vault_library_management");  
    
    if (!$db)
    {
        die("Connection failed :". mysqli_connect_error());
    }
    echo "Connected succesfully.";
					?>