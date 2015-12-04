<?php
    session_start();
    session_unset();
    session_destroy();
    echo "succesfuly logged out";
    echo "<p>proof: ";
    print_r($_SESSION);
    echo "</p>";
    header('Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/');
 ?>
