<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voch - Test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            width: 200px;
            position: absolute;
            z-index: 1;
            top: 0;
            left: -200px;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: 20px;
            transition: left 0.3s;
            margin-right: 40px;
        }

        .sidebar.active {
            left: 0;
        }

        #sidebarToggleBtn {
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            color: #333;
        }

        #sidebarCloseBtn {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #333;
        }

        .sidebar.active #sidebarCloseBtn {
            display: block;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
        }

        .sidebar a:hover {
            color: #007bff;
        }

        .main-content {
            width: 90%;
            margin-left: 40px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .main-content.active {
            margin-left: 200px;
        }

        .btn-group {
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            .main-content {
                width: 100%;
                margin-top: 20px;
            }

            #reportContent {
                overflow-x: scroll;
            }

            .sidebar {
                width: 100%;
                left: -100%;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.active {
                margin-left: 0;
            }

            .btn-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <button id="sidebarToggleBtn"><i class="fas fa-bars"></i></button>

    <div class="sidebar">
        <button id="sidebarCloseBtn"><i class="fas fa-times"></i></button>
        <a href="{{ route('unit.index') }}"><i class="fas fa-building"></i> Unidades</a>
        <a href="{{ route('employee.index') }}"><i class="fa-solid fa-user"></i> Colaboradores</a>
        <a href="{{ route('employee.evaluation') }}"><i class="fa-solid fa-user-check"></i> Desempenho</a>
        <a href="{{ route('employee.allEmployeesReport') }}"><i class="fa-solid fa-file"></i> Relatório de Colaboradores</a>
        <a href="{{ route('employee.byNotesReport') }}"><i class="fa-solid fa-file"></i> Relatório por Desempenho</a>
        {{-- <a href="{{ route('employee.allEmployeesReport') }}"><i class="fa-solid fa-file"></i> Relatório por Desempenho</a> --}}
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarToggleBtn').click(function() {
                $('.sidebar').toggleClass('active');
                $('.main-content').toggleClass('active');
            });

            $('#sidebarCloseBtn').click(function() {
                $('.sidebar').removeClass('active');
                $('.main-content').removeClass('active');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
