@extends('layouts.main-layout')
@section('page-name', 'POS - Report')
@section('title', 'Report - Index')

@section('main-content')
<div class="card shadow-lg border-0 rounded-3xl">
  <div class="card-body">
    <div class="pagetitle my-4 text-center">
      <h1 class="fw-bold text-uppercase text-primary">
        <i class="fas fa-chart-line"></i> Laporan Pemesanan
      </h1>
      <p class="text-muted">Harian | Kemarin | Mingguan | Custom Filter + Export</p>
    </div>

    <!-- Filter -->
    <div class="filter-container mb-4 p-3 bg-light rounded d-flex align-items-center flex-wrap gap-3 shadow-sm">
      <div>
        <label for="preset-filter" class="fw-semibold"><i class="fas fa-filter"></i> Preset:</label>
        <select id="preset-filter" class="form-control d-inline-block w-auto">
          <option value="">-- Pilih --</option>
          <option value="today">Hari Ini</option>
          <option value="yesterday">Kemarin</option>
          <option value="weekly">Mingguan</option>
          <option value="month">Dalam Sebulan</option>
        </select>
      </div>

      <div>
        <label for="start-date" class="fw-semibold">Start:</label>
        <input type="text" id="start-date" class="form-control d-inline-block w-auto" autocomplete="off">
      </div>

      <div>
        <label for="end-date" class="fw-semibold">End:</label>
        <input type="text" id="end-date" class="form-control d-inline-block w-auto" autocomplete="off">
      </div>

      <button id="reset-filter" class="btn btn-outline-secondary ms-auto">
        <i class="fas fa-sync-alt"></i> Reset
      </button>
    </div>

    <!-- Table -->
    <table id="tabelorder" class="table table-striped table-hover table-bordered nowrap w-100 shadow-sm rounded">
      <thead class="table-primary text-center">
        <tr>
          <th>Order Code</th>
          <th>Amount</th>
          <th>Order Date</th>
          <th>Order Change</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr data-href="{{ route('reportDetail', $order->id) }}">
            <td class="fw-semibold text-primary">{{ $order->order_code }}</td>
            <td class="text-success">{{ $order->formatted_amount }}</td>
            <td>{{ $order->order_date }}</td>
            <td class="text-danger">{{ $order->formatted_change }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<style>
  /* Tombol Export */
  .btn-csv { background:#3498db; color:white; border-radius:8px; margin-right:5px; }
  .btn-excel { background:#2ecc71; color:white; border-radius:8px; margin-right:5px; }
  .btn-pdf { background:#e74c3c; color:white; border-radius:8px; margin-right:5px; }
  .btn-print { background:#95a5a6; color:white; border-radius:8px; margin-right:5px; }
  .btn-csv:hover, .btn-excel:hover, .btn-pdf:hover, .btn-print:hover { opacity:0.9; }
</style>

<script>
  $(document).ready(function () {
    $("#start-date, #end-date").datepicker({
      dateFormat: 'yy-mm-dd'
    });

    var table = $('#tabelorder').DataTable({
      dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between mt-3"lip>',
      buttons: [
        { extend: 'csvHtml5', text: '<i class="fas fa-file-csv"></i> CSV', className: 'btn-csv' },
        { extend: 'excelHtml5', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn-excel', exportOptions: { modifier: { page: 'all' } } },
        { extend: 'pdfHtml5', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn-pdf' },
        { extend: 'print', text: '<i class="fas fa-print"></i> Print', className: 'btn-print' }
      ]
    });

    // format tanggal
    function formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;
      return [year, month, day].join('-');
    }

    // preset filter
    function applyPreset(preset) {
      var today = new Date(), start, end;
      if (preset === "today") start = end = today;
      if (preset === "yesterday") { start = new Date(); start.setDate(today.getDate() - 1); end = new Date(start); }
      if (preset === "weekly") { start = new Date(); start.setDate(today.getDate() - 6); end = today; }
      if (preset === "month") { start = new Date(); start.setDate(today.getDate() - 29); end = today; }
      if (start && end) {
        $("#start-date").val(formatDate(start));
        $("#end-date").val(formatDate(end));
        table.draw();
      }
    }

    // custom filter tanggal
    $.fn.dataTable.ext.search.push(function (settings, data) {
      var startDate = $('#start-date').val();
      var endDate = $('#end-date').val();
      var orderDate = new Date(data[2]);
      if (startDate) startDate = new Date(startDate);
      if (endDate) endDate = new Date(endDate);
      if ((!startDate && !endDate) || (!startDate && orderDate <= endDate) || (startDate <= orderDate && !endDate) || (startDate <= orderDate && orderDate <= endDate)) {
        return true;
      }
      return false;
    });

    $('#preset-filter').on('change', function () { applyPreset($(this).val()); });
    $('#start-date, #end-date').change(function () { $('#preset-filter').val(''); table.draw(); });
    $('#reset-filter').click(function () {
      $('#start-date, #end-date, #preset-filter').val('');
      table.search('').columns().search('').draw();
    });

    // default: tampilkan hari ini
    applyPreset("today");
  });
</script>
@endsection
