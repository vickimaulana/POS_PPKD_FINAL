<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('page-name')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="icon" href="{{ asset('logoppkjp.jpeg') }}" type="image/x-icon">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container-report h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .filter-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-container label {
            margin-right: 10px;
            font-weight: bold;
            color: #555;
        }

        .filter-container select,
        .filter-container input {
            margin-right: 20px;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        #reset-filter {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        #reset-filter:hover {
            background-color: #ff4d4d;
        }

        .dt-buttons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .dataTables_wrapper .dt-buttons button {
            background-color: #4CAF50;
            /* border: none; */
            color: white;
            padding: 8px 15px;
            margin-right: 5px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .dataTables_wrapper .dt-buttons button:hover {
            background-color: #23de2d;
        }

        .dataTables_wrapper .dt-buttons button span {
            margin-left: 6px;
        }

        .container-report table.dataTable {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .container-report table.dataTable thead th {
            background-color: #007BFF;
            color: white;
            text-align: center;
        }

        .container-report table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>

</head>

<body>
    @include('sweetalert::alert')

    @yield('content')

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    {{-- <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script> --}}
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('js/koi.js') }}"></script>

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('scripts')

@endsection

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  

    @yield('script')

    <script>
        $(document).ready(function() {
            var table = $('.datatable').DataTable();
        });
    </script>
<script src="{{ asset('public/assets/js/koi.js') }}"></script>
</body>

</html>
