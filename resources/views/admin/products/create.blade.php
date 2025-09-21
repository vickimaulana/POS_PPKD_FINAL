@extends('layouts.main-layout')
@section('page-name', 'POS - Product')

@section('main-content')
<section class="section">
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Add New Product</h5>
                  <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                      <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                      <select name="category_id" id="category_id" class="form-select">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                          </option>
                        @endforeach
                      </select>
                      @error('category_id')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                      <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" value="{{ old('product_name') }}" autofocus>
                      @error('product_name')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="product_photo" class="form-label">Product Photo</label>
                      <input type="file" name="product_photo" id="product_photo" class="form-control">
                      @error('product_photo')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="product_qty" class="form-label">Product Qty <span class="text-danger">*</span></label>
                      <input type="number" name="product_qty" id="product_qty" class="form-control" placeholder="Enter product price" value="{{ old('product_qty') }}">
                      @error('product_qty')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="product_price" class="form-label">Product Price <span class="text-danger">*</span></label>
                      <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" value="{{ old('product_price') }}">
                      @error('product_price')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="product_description" class="form-label">Product Description</label>
                      <textarea name="product_description" id="product_description" class="form-control" rows="4" placeholder="Enter product description">{{ old('product_description') }}</textarea>
                      @error('product_description')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-check mb-3 d-flex">
                      <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" checked>
                      <label for="is_active" class="form-check-label ms-2">Mark this product as active.</label>
                      @error('is_active')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                      <a href="{{ route('product.index') }}" class="btn btn-outline-secondary me-2" style="padding: 0.5rem 1rem; height: 2.5rem; line-height: 1.5rem;">Cancel</a>
                      <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; height: 2.5rem; line-height: 1.5rem;">Create</button>
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
