@extends('layouts.main-layout')
@section('page-name', 'POS - Stock Product')
@section('title', 'Stock - Index')

@section('main-content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-lg border-0 rounded-3xl">
        <div class="card-body">
          <!-- Title -->
          <div class="pagetitle my-4 text-center">
            <h1 class="fw-bold text-uppercase text-primary">
              <i class="fas fa-boxes"></i> @yield('title')
            </h1>
            <p class="text-muted">Lihat ketersediaan produk dan jumlah stok terbaru</p>
          </div>

          <!-- Product Table -->
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm rounded">
              <thead class="table-primary text-center">
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Stock Qty</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr>
                  <!-- Image -->
                  <td class="text-center">
                    @if($product['image'])
                        @if(Str::startsWith($product['image'], ['http://', 'https://']))
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="rounded-circle shadow" width="50" height="50">
                        @else
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="rounded-circle shadow" width="50" height="50">
                        @endif
                    @else
                        <span class="badge bg-secondary">No Image</span>
                    @endif
                  </td>

                  <!-- Name -->
                  <td class="fw-semibold">
                    {{ $product['name'] }}
                  </td>

                  <!-- Qty with badge color -->
                  <td class="text-center">
                    @php
                      $qty = $product['qty'];
                      $badgeClass = $qty > 20 ? 'success' : ($qty > 5 ? 'warning' : 'danger');
                    @endphp
                    <span class="badge bg-{{ $badgeClass }} px-3 py-2 fs-6">
                      {{ $qty }}
                    </span>
                  </td>
                </tr>
                @endforeach
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
@endsection
