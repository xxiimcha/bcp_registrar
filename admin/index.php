<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BCP - Admin Login</title>
    
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('./assets/img/admin-login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }
        .login-container {
            position: relative;
            max-width: 400px;
            width: 100%;
            z-index: 10;
        }
        .card {
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);
            background: rgba(30, 30, 30, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            color: #ffffff;
        }
        .btn-user {
            font-size: 1.1rem;
            padding: 12px;
            background: linear-gradient(90deg, #ff9800 0%, #ff5722 100%);
            border: none;
            transition: 0.3s;
            border-radius: 25px;
            color: white;
        }
        .btn-user:hover {
            background: linear-gradient(90deg, #ff5722 0%, #ff9800 100%);
        }
        .form-control-user {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #ff9800;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .form-control-user::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .alert {
            display: none;
            border-radius: 8px;
            background: #ff5722;
            color: white;
            border: none;
        }
        .spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="spinner-overlay">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="login-container">
        <div class="card">
            <div class="text-center">
                <h1 class="h4 mb-4">Admin Login</h1>
            </div>
            <div id="alertMessage" class="alert alert-danger"></div>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address / Username</label>
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email or Username..." required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
