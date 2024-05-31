<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .jumbotron {
            background-color: #f8f9fa;
        }
        .content-section {
            padding: 60px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="rooms">
                @if (Auth::check())
                    Welcome, {{ Auth::user()->name }}
                @else
                    Hotel Booking
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"> 
                    <li class="nav-item active">
                        <a class="nav-link" href="rooms">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to Hotel Booking</h1>
        <p class="lead">Find and book the perfect room for your stay.</p>
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a class="btn btn-primary btn-lg" href="/rooms/create" role="button">Dashboard</a>
        @elseif (!Auth::check())
            <a class="btn btn-primary btn-lg" href="/login" role="button">Get Started</a>
        @endif
    </div>

    <div class="container content-section">
        <div class="row">
            @foreach ($rooms as $itm)   
                <div class="col-lg-4 col-md-6 mb-4"> 
                    <div class="card h-100"> 
                        <div class="card-body">
                            <h5 class="card-title">Room Number: {{$itm->number}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$itm->type}}</h6>
                            <p class="card-text">{{$itm->description}}</p>
                            <p class="card-text"><strong>Price: ${{$itm->price}}</strong></p>
                            <div class="room-status">
                                @if ($itm->status == 'available')
                                    <span class="badge badge-success">Available</span>
                                @elseif ($itm->status == 'booked')
                                    <span class="badge badge-secondary">Booked</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </div>
                            @if ($itm->status == 'available')
                                <form action="{{route('reservations.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{$itm->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <input type="hidden" name="status" value="pending">
                                    <button class="btn btn-primary mt-3">Request Booking</button>
                                </form>
                            @elseif ($itm->status == 'booked')
                                <button class="btn btn-secondary mt-3" disabled>Booked</button>
                            @else
                                <button class="btn btn-warning mt-3" disabled>Pending</button>
                            @endif
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>

    <!-- About Us Section -->
    <div class="container content-section text-center">
        <h2>About Us</h2>
        <p>Learn more about our hotel and the services we offer.</p>
    </div>

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


