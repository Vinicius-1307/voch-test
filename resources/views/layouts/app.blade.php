<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voch - Test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <style>
        .active {
            display: flex !important;
        }

        .hide {
            display: none !important;
        }

        .sidebar_active {
            width: 250px;
            transition: all 0.3s ease-in-out;
            animation: scroll_sidebar 0.3s ease-in-out forwards;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            position: absolute;
            height: 100vh;
            padding: 16px 6px;
            top: 0;
            gap: 16px;
            border-radius: 0 20px 20px 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: all 0.3s ease-in-out;
            z-index: 1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn_sidebar {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar_active .btn_sidebar {
            justify-content: flex-end;
            padding-right: 16px;
        }

        #sidebarToggleBtn {
            all: unset;
            cursor: pointer;
        }

        #sidebarToggleBtn i {
            font-size: 24px;
            color: #007bff;
        }

        .action_sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .action_sidebar a {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            color: #141415;
            text-decoration: none;
            transition: all 0.25s ease-in-out;
        }

        .action_sidebar a i {
            font-size: 24px;
            color: #007bff;
        }

        .action_sidebar a span {
            display: none;
            text-align: center;
            font-size: 20px;
        }

        .sidebar_active .action_sidebar a span {
            display: flex;
        }

        .sidebar_active .action_sidebar a {
            justify-content: flex-start;
        }

        .action_sidebar a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .action_sidebar a:hover i {
            color: #f8f9fc;
        }

        .main-content {
            padding: 16px 100px;
        }

        .main_content_active {
            padding-left: 280px;
            transition: all 0.3s ease-in-out;
        }


        @keyframes scroll_sidebar {
            0% {
                transform: translateX(-80%);
            }

            100% {
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {

            .main-content {
                padding: 64px 16px;
            }

            .main_content_active {
                padding-left: 16px;
            }

            .sidebar {
                height: auto;
                padding: 16px;
                border-radius: 12px;
            }

            #sidebarToggleBtn i {
                font-size: 28px;
            }

            .action_sidebar {
                display: none;
            }

            .sidebar_active .action_sidebar {
                display: flex;
            }

            #reportContent {
                overflow-x: scroll;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="btn_sidebar">
            <button id="sidebarToggleBtn">
                <i id="icon_btn" class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
        <div class="action_sidebar">
            <a href="{{ route('unit.index') }}">
                <i class="fas fa-building"></i>
                <span>Unidades</span>
            </a>
            <a href="{{ route('employee.index') }}">
                <i class="fa-solid fa-user-plus"></i>
                <span>Colaboradores</span>
            </a>
            <a href="{{ route('employee.evaluation') }}">
                <i class="fa-solid fa-user-check"></i>
                <span>Desempenho</span>
            </a>
            <a href="{{ route('employee.allEmployeesReport') }}">
                <i class="fa-solid fa-users"></i>
                <span>Relatório de Colaboradores</span>
            </a>
            <a href="{{ route('employee.byNotesReport') }}">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Relatório por Desempenho</span>
            </a>
            <a href="{{ route('employee.byUnitsReport') }}">
                <i class="fa-solid fa-file"></i>
                <span>Relatório por Unidades</span>
            </a>
        </div>
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
                $('#icon_btn').toggleClass('fa-caret-right fa-times');
                $('.sidebar').toggleClass('sidebar_active');
                $('.main-content').toggleClass('main_content_active');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
