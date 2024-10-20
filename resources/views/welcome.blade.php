<!-- resources/views/signup.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <!-- Include Bootstrap for base styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #929dbe;
            /* Light blue background to match */
            font-family: 'Arial', sans-serif;
        }

        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 15px;
        }

        .signup-card {
            background-color: rgba(255, 255, 255, 0.452);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
            position: relative;
        }

        .signup-card h3 {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .signup-card input[type="text"],
        .signup-card input[type="email"],
        .signup-card input[type="password"] {
            margin-bottom: 15px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .btn-signup {
            background-color: #000;
            color: white;
            font-size: 16px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            margin-top: 10px;
            border: none;
        }

        .btn-signup:hover {
            background-color: #333;
        }

        .or-divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .or-divider:before,
        .or-divider:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ccc;
        }

        .or-divider:before {
            left: 0;
        }

        .or-divider:after {
            right: 0;
        }

        .or-divider span {
            background-color: rgba(255, 255, 255, 0);
            padding: 0 10px;
            color: #777;
        }

        .social-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .social-buttons a {
            text-align: center;
            width: 48%;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            text-decoration: none;
            color: white;
        }

        .google-btn {
            background-color: #db4a39;
        }

        .facebook-btn {
            background-color: #3b5998;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            text-decoration: none;
            color: #000;
        }

        .login-link a:hover {
            color: #333;
        }
    </style>
</head>

<body>

    <div class="signup-container">
        <div class="signup-card">
            <h3>Sign Up</h3>
            <form>
                @csrf
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit" class="btn-signup">Sign Up</button>
            </form>

            <div class="or-divider"><span>Or</span></div>

            {{-- <div class="social-buttons">
            <a href="{{ url('auth/google') }}" class="google-btn">Sign up with Google</a>
            <a href="{{ url('auth/facebook') }}" class="facebook-btn">Sign up with Facebook</a>
        </div> --}}

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Log in</a>
            </div>
        </div>
    </div>

</body>

</html>
