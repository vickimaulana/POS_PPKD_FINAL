@extends('layouts.main-layout')
@section('page-name', 'POS - Edit User')

@section('main-content')
<section class="section">
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Edit User</h5>
                  <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                      <label for="name" class="form-label">User Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" 
                             placeholder="Example: FUFUFAFA" 
                             value="{{ old('name', $user->name) }}" autofocus>
                      @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="email" class="form-label">Email User <span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" class="form-control" 
                             placeholder="Example: FUFUFAFA@gmail.com" 
                             value="{{ old('email', $user->email) }}">
                      @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password 
                        <small class="text-muted">(Optional)</small>
                      </label>
                      <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Input the password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="role" class="form-label">Choose Role <span class="text-danger">*</span></label>
                      <select name="role_id" id="role" class="form-select">
                        <option value="" disabled>Choose One</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                            {{ $role->name }}
                          </option>
                        @endforeach
                      </select>
                      @error('role_id')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary me-2" style="padding: 0.5rem 1rem; height: 2.5rem; line-height: 1.5rem;">Cancel</a>
                      <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; height: 2.5rem; line-height: 1.5rem;">Update</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $('#togglePassword').on('click', function () {
    const passwordField = $('#password');
    const icon = $(this).find('i');
    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      icon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      passwordField.attr('type', 'password');
      icon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });
</script>
@endsection
