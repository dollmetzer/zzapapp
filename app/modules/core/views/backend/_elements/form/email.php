<?php

echo '<input id="formfield_'.$name.'" type="email" name="';
echo $name . '" ';
if (!empty($field['readonly'])) {
    echo 'readonly="readonly" ';
}
if(!empty($field['placeholder'])) {
    echo 'placeholder="'.$field['placeholder'].'" ';
}
echo 'value="' . $field['value'] . '" class="form-control" />';

?>