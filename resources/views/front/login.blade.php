@extends('front\layout')

@section('content')

    <!-- Sign Up / Login Section -->
    <div class="container content-section">
        <div class="form-container">
            <ul class="nav nav-tabs" id="authTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a>
                </li>
            </ul>
            <div class="tab-content" id="authTabsContent">
                <!-- Login Form -->
                @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <form class="mt-4" action="{{route('login')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="loginEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Password">
                        </div>
                        <a href="dashboard.html"><button type="submit" class="btn btn-primary btn-block">Login</button></a>
                    </form>
                </div>
                <!-- Sign Up Form -->
                <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                    <form class="mt-4" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="signupName">Full Name</label>
                            <input type="text" name="name" class="form-control" id="signupName" placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="signupEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="signupEmail" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="signupPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
