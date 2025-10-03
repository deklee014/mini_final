<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4338ca;
        }
        .login-link {
            margin-top: 10px;
            text-align: center;
        }
        .login-link a {
            color: #4f46e5;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            <!-- Name -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your full name" required>

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>

            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <!-- Confirm Password -->
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>

            <!-- Role -->
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="member">Member</option>
                <option value="staff">Staff</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Register</button>

            <div class="login-link">
                Already have an account? <a href="login.html">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
