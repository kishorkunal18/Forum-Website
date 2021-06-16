<?php
session_start();
echo "Logging you Out!Please Wait...";
session_destroy();
header("Location: /forum");

?>