@extends('layout.main')

@section('content')

<title>Investphil | User Authentication</title>

<style>
    body {
        margin: 0;
        padding: 0;
        background: url('data:image/png;base64,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') center/cover no-repeat fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    main#main {
        background: white;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 100px;
        max-width: 1000px;
        animation: fadeIn 1s;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #login-right {
        text-align: center;
    }

    #login-left {
        display: none;
    }

    #login-right .card {
        display: inline-block;
        margin: auto;
        animation: bounceIn 1s;
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0);
        }

        60% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .logo {
        font-size: 8rem;
        background: #fff;
        padding: .7em;
        border-radius: 50%;
        color: #007bff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    #login-form {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        animation: slideInUp 1s;
    }

    @keyframes slideInUp {
        0% {
            transform: translateY(100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
    
@include('include.messages')

<div class="container">
    <div id="login-right" class="bg-light pt-3 pb-3">
        <div class="mx-auto">
            <h4 class="text-center" id="investphil-title"><b>INVESTPHIL</b></h4>
            <div class="card">
                <div class="card-body">
                    <form action="/process_login" method="post" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <p>Don't have an account yet? <a href="#">Register</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection