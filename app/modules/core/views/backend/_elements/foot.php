        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



        <!-- BEGIN Modal confirm delete -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php $this->lang('txt_core_deleteconfirm'); ?></h4>
                    </div>
                    <div class="modal-body"><?php $this->lang('msg_core_deleteconfirm'); ?></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php $this->lang('link_core_cancel'); ?></button>
                        <a class="btn btn-danger btn-ok"><?php $this->lang('link_core_delete'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>
        <!-- END Modal confirm delete -->

        <?php if( !empty($_SESSION['flasherror']) || !empty($_SESSION['flashmessage'])) { ?>
            <script type="text/javascript">
                $('#flash').modal({show:true})
            </script>
        <?php } ?>



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