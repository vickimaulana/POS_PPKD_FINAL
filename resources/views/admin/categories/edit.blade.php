@extends('layouts.main-layout')
@section('page-name', 'POS - Edit category')

@section('main-content')
<section class="section">
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Edit category</h5>
                  <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                      <label for="name" class="form-label">Category Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" 
                             placeholder="Example: Makanan Tradisional" 
                             value="{{ old('name', $category->category_name) }}" autofocus>
                      @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                      <a href="{{ route('category.index') }}" class="btn btn-outline-secondary me-2" style="padding: 0.5rem 1rem; height: 2.5rem; line-height: 1.5rem;">Cancel</a>
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

@endsection
