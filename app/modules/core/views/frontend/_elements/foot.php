
<?php
if(DEBUG_SESSION === true) {
    echo "<pre>\n";
    print_r($_SESSION);
    echo "</pre>\n\n";
}

if(DEBUG_CONTENT === true) {
    echo "<pre>\n";
    print_r($content);
    echo "</pre>\n\n";
}

?>
</body>
</html>