</div>

<footer>[
    <?php
    foreach( $this->config['languages'] as $l ) {
        echo '<a href="'.$this->buildURL('core/language/switchto/'.$l, false).'">'.$l.'</a> ';
    } ?>]

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
</footer>

<?php
$js = $this->getJS();
if(!empty($js)) {
    echo "<!-- Additional JS Files -->\n";
    for($i=0; $i<sizeof($js); $i++) {
        echo '    <script src="';
        echo $js[$i];
        echo '"></script>';
        echo "\n";
    }
}
?>

</body>
</html>