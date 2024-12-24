<h1>This is welcome page</h1>

<p>Message :: <?php echo $message; ?></p>
<p>Boolean :: <?php echo $isit; ?></p>
<p>Number :: <?php echo $number; ?></p>

<?php

    if(storage_exists("okay.txt")) {
        echo "File exists";
        storage_unlink("okay.txt");
    } else {
        echo "File doesn't exists";
    }

?>

<p><?php echo asset("style/asset.css"); ?></p>