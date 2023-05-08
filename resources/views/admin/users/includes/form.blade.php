<div class="row">
    <x-adminlte-input type="text"
                      name="name"
                      label="{{ __('Name') }}"
                      value="{{ old('name', $user->name ?? '') }}"
                      fgroup-class="col-md-12"/>
</div>

<div class="row">
    <x-adminlte-input type="email"
                      name="email"
                      label="Email"
                      value="{{ old('email', $user->email ?? '') }}"
                      fgroup-class="col-md-12"/>
</div>

<div class="row">
    <x-adminlte-input type="password"
                      name="password"
                      label="{{ __('Password') }}"
                      fgroup-class="col-md-12"/>
</div>

<div class="row">
    <x-adminlte-input type="password"
                      name="password_confirmation"
                      label="{{ __('Password Confirmation') }}"
                      fgroup-class="col-md-12"/>
</div>

@foreach($roles as $role)
    <div class="custom-control custom-checkbox">
        <input
            class="custom-control-input"
            type="checkbox"
            id="checkbox-{{ $role->id }}"
            name="roles[]"
            value="{{ $role->id }}"
            {{ in_array($role->id, $rolesAssign) ? 'checked' : '' }}>
        <label for="checkbox-{{ $role->id }}" class="custom-control-label">{{ $role->name }}</label>
    </div>
@endforeach
