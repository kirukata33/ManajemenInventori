<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - InventManager</title>
    <style>
        @page {
            margin: 100px 25px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        header {
            position: fixed;
            top: -75px;
            left: 0px;
            right: 0px;
            height: 60px;
            text-align: center;
            border-bottom: 2px solid #1E1B4B;
        }
        .header-logo {
            font-size: 24px;
            font-weight: bold;
            color: #1E1B4B;
            margin: 0;
            padding: 0;
        }
        .header-title {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 30px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            font-size: 10px;
            color: #777;
        }
        .page-number:before {
            content: "Halaman " counter(page);
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .float-left {
            float: left;
        }
        .float-right {
            float: right;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .info-section {
            margin-bottom: 15px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th {
            background-color: #1E1B4B;
            color: #ffffff;
            font-weight: bold;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        table.data-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-danger {
            background-color: #ffe4e6;
            color: #e11d48;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #059669;
        }
    </style>
</head>
<body>

    <header>
        <div class="header-logo">InventManager</div>
        <div class="header-title">@yield('title')</div>
    </header>

    <footer>
        <div class="float-left">
            Dicetak pada: {{ $tanggal }} &nbsp;|&nbsp; Sistem Manajemen Inventori
        </div>
        <div class="float-right page-number"></div>
        <div class="clearfix"></div>
    </footer>

    <main>
        @yield('content')
    </main>

</body>
</html>
