<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Employee Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding: 15px;
            position: fixed;
            width: 250px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-left: 250px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>  
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/rooms">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/rooms/create">Manage Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('reservations.index')}}">Manage Requests</a>
            </li>
        </ul>
    </div>

    <!-- Content -->

    @yield('content')
 



    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="m-0">© 2024 Hotel Booking. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@yield('scripts')