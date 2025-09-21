@extends('layouts.main-layout')
@section('page-name', 'POS - Category')
@section('title', 'Category - Index')

@section('main-content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">

          <!-- Page Title -->
          <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-uppercase mb-0 border-bottom pb-2">@yield('title')</h1>
            <a href="{{ route('category.create') }}" class="btn btn-primary rounded-pill shadow-sm">
              <i class="bi bi-plus-circle me-1"></i> Add Category
            </a>
          </div>

          <!-- Table -->
          <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col" style="width:150px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($datas as $category)
                  <tr>
                    <td class="fw-semibold">{{ $category->category_name }}</td>
                    <td>
                      <!-- Edit -->
                      <a href="{{ route('category.edit', $category->id) }}" 
                         class="btn btn-sm btn-outline-secondary rounded-circle me-1" 
                         title="Edit">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <!-- Delete -->
                      <form class="d-inline" 
                            action="{{ route('category.destroy', $category->id) }}" 
                            method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-sm btn-outline-danger rounded-circle btn-hapus" 
                                data-name="{{ $category->category_name }}" 
                                title="Delete">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="2"><em class="text-muted">No categories available.</em></td>
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
      backdrop: `
        rgba(0,0,0,0.4)
        left top
        no-repeat
      `
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
</script>
@endsection
