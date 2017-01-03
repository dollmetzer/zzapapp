<form <?php
if(!empty($content['form']['action'])) {
    echo 'action="'.$content['form']['action'].'" ';
} else {
    echo 'action="" ';
}
if (!empty($content['form']['name'])) {
    echo 'name="' . $content['form']['name'] . '" ';
}
echo 'enctype="multipart/form-data" method="post" role="form" data-toggle="validator" >';
echo "\n\n";

$hasRequired = false;

// all hidden fields on top
foreach ($content['form']['fields'] as $name => $field) {
    if($field['type'] == 'hidden') {
        echo '<input id="formfield_'.$name.'" type="hidden" name="'.$name.'" value="'.$field['value']."\" />\n";
    }
}
$focus = '';

foreach ($content['form']['fields'] as $name => $field) {
    if($field['type'] != 'hidden') {

        if(!empty($field['error'])) {
            echo "<div class='form-group has-error' id='formblock_$name'>\n";
        } else {
            echo "<div class='form-group' id='formblock_$name'>\n";
        }

        if ($field['type'] != 'divider') {
            echo "    <label for='formfield_$name' class='control-label'>" . $this->lang('form_label_' . $name, false);
            if (!empty($field['required'])) {
                echo '&nbsp;<sup>*</sup>';
                $hasRequired = true;
            } else {
                echo '&nbsp;<sup>&nbsp;</sup>';
            }
            echo "</label>\n";
        }


        $element = PATH_APP.'modules/core/views/backend/_elements/form/'.$field['type'].'.php';
        include $element;


        if(!empty($field['error'])) {
            echo "<p class='text-danger'><strong>".$field['error']."</strong></p>\n";
        }

        if (!empty($field['helptext'])) {
            echo "    <p class=\"help-block\">".$field['helptext']."</p>\n";
        }
        echo "</div>\n\n";
    }
}
?>

    <div class="form-group">
        <label>Text Input</label>
        <input class="form-control" placeholder="placeholder text"/>
        <p class="help-block">Insert help text here</p>
    </div>


    <div class="form-group">
        <label>Static</label>
        <p class="form-control-static">Static Text</p>
    </div>


    <div class="form-group">
        <label>Text Area</label>
        <textarea class="form-control" rows="3"></textarea>
    </div>


    <div class="form-group">
        <label>Checkboxes</label>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="" /> Checkbox 1
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="" /> Checkbox 2
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="" /> Checkbox 3
            </label>
        </div>
    </div>


    <div class="form-group">
        <label>Inline Checkboxes</label>
        <div class="checkbox-inline">
            <label>
                <input type="checkbox" value="" /> 1
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="checkbox" value="" /> 2
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="checkbox" value="" /> 3
            </label>
        </div>
    </div>



    <div class="form-group">
        <label>Radiobuttons</label>
        <div class="radio">
            <label>
                <input type="radio" name="blockradio" value="br1" /> Radio 1
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="blockradio" value="br2" /> Radio 2
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="blockradio" value="br3" /> Radio 3
            </label>
        </div>
    </div>


    <div class="form-group">
        <label>Inline Radiobuttons</label>
        <div class="radio-inline">
            <label>
                <input type="radio" name="ilradio" value="ir1" /> 1
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="ilradio" value="ir2" /> 2
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="ilradio" value="ir3" /> 3
            </label>
        </div>
    </div>


    <div class="form-group">
        <label>Selects</label>
        <select class="form-control">
            <option value="">--- please select ---</option>
            <option value="s1">Option One</option>
            <option value="s2">Option Two</option>
        </select>
    </div>


    <div class="form-group">
        <label>Multiple Selects</label>
        <select class="form-control" multiple="multiple" size="3">
            <option value="s1">Option One</option>
            <option value="s2">Option Two</option>
            <option value="s3">Option Three</option>
            <option value="s4">Option Four</option>
            <option value="s5">Option Five</option>
            <option value="s6">Option Six</option>
        </select>
    </div>


    <div class="form-group">
        <label>File Input</label>
        <input type="file">
    </div>


    <button class="btn btn-default" type="submit">Submit</button>

    <button class="btn btn-default" type="reset">Reset</button>

</form>