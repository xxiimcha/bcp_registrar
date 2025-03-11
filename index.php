<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BCP - Student Login</title>
    
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('./assets/img/login-bg.jpg') no-repeat center center fixed;
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
            background: rgba(20, 50, 100, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            color: #ffffff;
        }
        .btn-user {
            font-size: 1.1rem;
            padding: 12px;
            background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%);
            border: none;
            transition: 0.3s;
            border-radius: 25px;
            color: white;
        }
        .btn-user:hover {
            background: linear-gradient(90deg, #3b82f6 0%, #1e3a8a 100%);
        }
        .form-control-user {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #3b82f6;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .form-control-user::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .alert {
            display: none;
            border-radius: 8px;
            background: #1e3a8a;
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
                <h1 class="h4 mb-4">Student Login</h1>
            </div>
            <div id="alertMessage" class="alert alert-danger"></div>
            <form id="loginForm">
                <div class="form-group">
                    <label for="studentNumber">Student Number</label>
                    <input type="text" class="form-control form-control-user" id="studentNumber" name="studentNumber" placeholder="Enter Student Number..." required pattern="[0-9-]+" title="Only numbers and dashes are allowed">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("studentNumber").addEventListener("input", function(event) {
            this.value = this.value.replace(/[^0-9-]/g, '');
        });

        document.getElementById("loginForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            
            let studentNumber = document.getElementById("studentNumber").value;
            let password = document.getElementById("password").value;
            let alertMessage = document.getElementById("alertMessage");
            let loginButton = document.querySelector(".btn-user");
            let spinnerOverlay = document.querySelector(".spinner-overlay");
            
            spinnerOverlay.style.display = "flex";
            loginButton.disabled = true;
            
            try {
                let response = await fetch("controllers/LoginController.php?action=student", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ studentNumber: studentNumber, password: password })
                });
                
                let result = await response.json();
                spinnerOverlay.style.display = "none";
                loginButton.disabled = false;
                
                if (result.status === "success") {
                    window.location.href = result.redirect;
                } else {
                    alertMessage.style.display = "block";
                    alertMessage.innerHTML = result.message;
                }
            } catch (error) {
                spinnerOverlay.style.display = "none";
                loginButton.disabled = false;
                alertMessage.style.display = "block";
                alertMessage.innerHTML = "An error occurred. Please try again.";
            }
        });
    </script>
</body>
</html>
