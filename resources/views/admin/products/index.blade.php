@extends('layouts.main-layout')
@section('page-name', 'POS - Product')
@section('title', 'Product - Index')

@section('main-content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <!-- Header -->
                    <div class="pagetitle mt-4 mb-4 d-flex justify-content-between align-items-center">
                        <h1 class="fw-bold text-uppercase text-primary">@yield('title')</h1>
                        <a href="{{ route('product.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Add Product
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle datatable">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $product)
                                    <tr>
                                        <!-- Image -->
                                        <td class="text-center">
                                            @if ($product->product_photo)
                                                @if (Str::startsWith($product->product_photo, ['http://', 'https://']))
                                                    <img src="{{ $product->product_photo }}"
                                                         alt="{{ $product->product_name }}"
                                                         class="rounded shadow-sm"
                                                         width="55" height="55">
                                                @else
                                                    <img src="{{ asset('storage/' . $product->product_photo) }}"
                                                         alt="{{ $product->product_name }}"
                                                         class="rounded shadow-sm"
                                                         width="55" height="55">
                                                @endif
                                            @else
                                                <span class="text-muted fst-italic">No Image</span>
                                            @endif
                                        </td>

                                        <!-- Data -->
                                        <td class="fw-semibold">{{ $product->product_name }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td class="text-center">{{ $product->product_qty }}</td>
                                        <td class="text-success fw-bold">{{ $product->formatted_price }}</td>
                                        <td>
                                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="text-center">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                               class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form class="d-inline" action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-hapus btn-danger"
                                                        data-name="{{ $product->product_name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Table -->
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
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="bi bi-trash"></i> Yes, delete it!',
            cancelButtonText: '<i class="bi bi-x-circle"></i> Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
