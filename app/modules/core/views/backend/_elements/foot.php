        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/backend/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/backend/vendor/metisMenu/metisMenu.min.js"></script>

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

    <!-- Custom Theme JavaScript -->
    <script src="/backend/dist/js/sb-admin-2.js"></script>

</body>

</html>