<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eBarangay Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8; /* Soft solid gray, no gradient */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 16px;
        }

        .app-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 32px 24px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 32px;
            font-weight: 400;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 1rem;
            color: #0f172a;
            box-shadow: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        
        .form-control::placeholder {
            color: #94a3b8;
        }

        .input-group-custom {
            margin-bottom: 20px;
        }

        .btn-login {
            border-radius: 12px;
            padding: 14px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s ease;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-login:hover, .btn-login:active {
            background-color: #1d4ed8;
            color: #ffffff;
        }

        .link-container {
            text-align: center;
            margin-top: 24px;
        }

        .link {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            padding: 12px;
            margin-bottom: 24px;
        }

    </style>
</head>

<body>

<div class="app-card">

    <div class="logo">🏛️ eBarangay</div>
    <div class="subtitle">Resident Login</div>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group-custom">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
        </div>

        <div class="input-group-custom">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-login w-100">Login</button>
    </form>

    <div class="link-container">
        <a href="/register" class="link">Create Account</a>
    </div>

</div>

</body>
</html>