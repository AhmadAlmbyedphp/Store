
   @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Errors!</h5>
        @foreach ( $errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
        </div>
    @endif
<div class="card-body">
    {{-- name --}}
    <div class="form-group">
        <x-form.input label="Roles Name"
        name="name" :value="$role->name"/>
    </div>
    <fieldset>
        <legend>{{  __('Abilities')}}</legend>
            @foreach ( config('abilites') as $ability_code => $ability_name)
            <div class="row md-4">
                <div class="col-md-6">
                 {{$ability_name}}
                </div>
                <div class="col-md-2">
                   <input type="radio" name="abilities[{{$ability_code}}]" value = "allow"
                   @if ($role_abilities[$ability_code] == 'allow' ) checked  @endif
                   {{-- @checked(($role_abilities[$ability_code] ?? '') == 'allow') --}}
                   >
                   Allow
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{$ability_code}}]" value = "deny"
                    @if ($role_abilities[$ability_code] == 'deny' )checked  @endif
                    {{-- @checked(($role_abilities[$ability_code] ?? '') == 'deny') --}}
                    >
                    Deny
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{$ability_code}}]" value = "inherit"
                    @if ($role_abilities[$ability_code] == 'inherit' )checked  @endif
                    {{-- @checked(($role_abilities[$ability_code] ?? '') == 'inherit') --}}
                    >
                    Inherit
                </div>
            </div>
            @endforeach
    </fieldset>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label?? 'save'}}</button>
</div>
