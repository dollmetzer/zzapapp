<?php
$content['nav_main'] = 'stream';
include PATH_APP . 'modules/core/views/frontend/_elements/head.php';


// entry form
if($this->userInGroup('user')) { ?>
    <form action="<?php $this->buildURL('stream/message/new'); ?>" method="post">
        <div class='form-group' id='formblock_subject'>
            <label for='formfield_subject' class='control-label'><?php $this->lang('form_label_subject'); ?>&nbsp;<sup><i class="glyphicon glyphicon-asterisk"></i></sup></label>
            <input type="text" name="subject" class="form-control" maxlength="128" />
        </div>

        <div class='form-group' id='formblock_message'>
            <label for='formfield_subject' class='control-label'><?php $this->lang('form_label_message'); ?>&nbsp;<sup><i class="glyphicon glyphicon-asterisk"></i></sup></label>
            <textarea name="message" class="form-control" rows="6"></textarea>
        </div>

        <div class='form-group' id='formblock_submit'>
            <label for='formfield_subject' class='control-label'>&nbsp;</label>
            <input type="submit" name="submit" value="<?php $this->lang('form_btn_submit_login'); ?>" class="btn btn-primary" />
        </div>
    </form>
<?php }


// messages
if(empty($content['messages'])) {

    echo '<p>';
    $this->lang('msg_no_messages');
    echo "</p>";

} else {

    if($content['table']->page > 0) {
        include PATH_APP.'modules/core/views/frontend/_elements/pagination.php';
    }

    foreach($content['messages'] as $message) {

        echo '<div class="panel panel-default">';

        echo '<div class="panel-heading">';
        echo '<strong>'.$message['subject']."</strong>\n";
        echo "</div>\n";

        echo '<div class="panel-body">';
        echo '<p><strong>'.$message['from']."</strong>&nbsp;";
        echo $this->toDatetimeShort($message['written'], false)."</strong></p>\n";
        echo '<p>'.nl2br($message['body'])."</p>";
        echo "</div>\n";

        echo "</div>\n";

    }

    if($content['table']->page < $content['table']->maxPage-1) {
        include PATH_APP.'modules/core/views/frontend/_elements/pagination.php';
    }

}


include PATH_APP . 'modules/core/views/frontend/_elements/foot.php';
?>