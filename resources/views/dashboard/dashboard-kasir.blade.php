
@extends('layouts.main-layout')
@section('page-name', 'POS - Dashboard Kasir')
@section('title', 'Dashboard Kasir')

@section('main-content')
<div class="pagetitle">
  <h1>Dashboard</h1>
</div>
<section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Sales <span>| Today</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $SalesToday }}</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-md-6">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Revenue <span>| Today</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>{{'Rp. ' . number_format($AmountToday, 0, ',', '.');}}</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">Recent Sales <span>| Today</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Order Code</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Change</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($LastOrders as $order)
                    <tr>
                      <td>{{ $order->order_code }}</td>
                      <td>{{ $order->formatted_date}}</td>
                      <td>{{ $order->formatted_amount }}</td>
                      <td>{{ $order->formatted_change }}</td>
                    </tr>
                  @endforeach
                </tbody>
                
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

      

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">
              <h5 class="card-title">Product <span>| Low Stock</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($LowStock as $product)
                    <tr>
                      <td><span class="text-primary fw-bold">{{ $product->product_name }}</span></td>
                      <td class="fw-bold">{{ $product->product_qty }}</td>
                    </tr>
                  @endforeach
                </tbody>                
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->


    </div><!-- End Right side columns -->

  </div>
</section>
@endsection

@section('script')
  
@endsection