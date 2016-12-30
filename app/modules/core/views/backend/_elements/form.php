<form role="form">


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