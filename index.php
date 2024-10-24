<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Slider Login / Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="container">

        <div class="form-container register-container">
            <form method="post" action="register.php">
                <h1>Register here</h1>
                <input type="text" name="fName" id="fName" placeholder="Name" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>

                <!-- Role Selection -->
                <label for="role">Select Role:</label>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button class="custom-button" type="submit" name="signUp">Register</button>
                <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        </div>

        <div class="form-container login-container">
            <form method="post" action="register.php">
                <h1>Login here</h1>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label>Remember me</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
                <button class="custom-button" type="submit" name="signIn">Login</button>
                <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Hello <br> friends</h1>
                    <p>if your have an account, login here and have fun</p>
                    <button class="ghost" id="signIn">Login
                        <i class="lni lni-arrow-left signIn"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="titel">Start your <br> journey now</h1>
                    <p>if you don't have an account yet, join us and start your journey.</p>
                    <button class="ghost" id="signUp">Register
                        <i class="lni lni-arrow-right signUp"></i>
                    </button>
                </div>
            </div>
        </div>

        <script src="script.js"></script>

    </div>
</body>
</html>