@extends('layouts.main-layout')
@section('page-name', 'POS - User')
@section('title', 'User - Index')

@section('main-content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">

          <!-- Page Title -->
          <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-uppercase mb-0 border-bottom pb-2">@yield('title')</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill shadow-sm">
              <i class="bi bi-person-plus me-1"></i> Add User
            </a>
          </div>

          <!-- Table -->
          <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col" style="width:150px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($datas as $user)
                  <tr>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @php
                        $badgeClass = 'secondary';
                        if ($user->role_name == 'Administrator') $badgeClass = 'danger';
                        if ($user->role_name == 'Pimpinan') $badgeClass = 'info';
                        if ($user->role_name == 'Kasir') $badgeClass = 'success';
                      @endphp
                      <span class="badge bg-{{ $badgeClass }} px-3 py-2">{{ $user->role_name }}</span>
                    </td>
                    <td>
                      <!-- Edit -->
                      <a href="{{ route('users.edit', $user->id) }}" 
                         class="btn btn-sm btn-outline-secondary rounded-circle me-1" 
                         title="Edit">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <!-- Delete -->
                      <form class="d-inline" action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-sm btn-outline-danger rounded-circle btn-hapus" 
                                data-name="{{ $user->name }}" 
                                title="Delete">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4"><em class="text-muted">No users available.</em></td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $('.btn-hapus').click(function(e) {
    e.preventDefault(); 
    var form = $(this).closest('form');
    var dataName = $(this).data('name');

    Swal.fire({
      title: `Delete "${dataName}"?`,
      text: "This action cannot be undone!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<i class="bi bi-check-circle"></i> Yes, delete it!',
      cancelButtonText: '<i class="bi bi-x-circle"></i> Cancel',
      reverseButtons: true,
      background: '#fff',
      backdrop: `rgba(0,0,0,0.4)`
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
</script>
@endsection
