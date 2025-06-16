<div class="form-group {{ $errors->has('Tier') ? 'has-error' : ''}}">
    <label for="Tier" class="control-label">{{ 'Tier' }}</label>
    <input class="form-control" name="Tier" type="text" id="Tier" value="{{ isset($chief_gear->Tier) ? $chief_gear->Tier : ''}}" >
    {!! $errors->first('Tier', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Stars') ? 'has-error' : ''}}">
    <label for="Stars" class="control-label">{{ 'Stars' }}</label>
    <input class="form-control" name="Stars" type="text" id="Stars" value="{{ isset($chief_gear->Stars) ? $chief_gear->Stars : ''}}" >
    {!! $errors->first('Stars', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Hardened_Alloy') ? 'has-error' : ''}}">
    <label for="Hardened_Alloy" class="control-label">{{ 'Hardened Alloy' }}</label>
    <input class="form-control" name="Hardened_Alloy" type="text" id="Hardened_Alloy" value="{{ isset($chief_gear->Hardened_Alloy) ? $chief_gear->Hardened_Alloy : ''}}" >
    {!! $errors->first('Hardened_Alloy', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Polishing_Solution') ? 'has-error' : ''}}">
    <label for="Polishing_Solution" class="control-label">{{ 'Polishing Solution' }}</label>
    <input class="form-control" name="Polishing_Solution" type="text" id="Polishing_Solution" value="{{ isset($chief_gear->Polishing_Solution) ? $chief_gear->Polishing_Solution : ''}}" >
    {!! $errors->first('Polishing_Solution', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Design_Plans') ? 'has-error' : ''}}">
    <label for="Design_Plans" class="control-label">{{ 'Design Plans' }}</label>
    <input class="form-control" name="Design_Plans" type="text" id="Design_Plans" value="{{ isset($chief_gear->Design_Plans) ? $chief_gear->Design_Plans : ''}}" >
    {!! $errors->first('Design_Plans', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Lunar_Amber') ? 'has-error' : ''}}">
    <label for="Lunar_Amber" class="control-label">{{ 'Lunar Amber' }}</label>
    <input class="form-control" name="Lunar_Amber" type="text" id="Lunar_Amber" value="{{ isset($chief_gear->Lunar_Amber) ? $chief_gear->Lunar_Amber : ''}}" >
    {!! $errors->first('Lunar_Amber', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Power') ? 'has-error' : ''}}">
    <label for="Power" class="control-label">{{ 'Power' }}</label>
    <input class="form-control" name="Power" type="text" id="Power" value="{{ isset($chief_gear->Power) ? $chief_gear->Power : ''}}" >
    {!! $errors->first('Power', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
