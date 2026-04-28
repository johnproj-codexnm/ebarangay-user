<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eBarangay Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8; /* Solid flat color */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            margin: 0;
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
            margin-bottom: 24px;
            font-weight: 400;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 8px;
            margin-left: 4px;
            margin-top: 16px;
            text-transform: uppercase;
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
            margin-bottom: 16px;
        }

        .btn-register {
            border-radius: 12px;
            padding: 14px;
            background-color: #16a34a; /* Solid Green */
            color: #ffffff;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s ease;
            margin-top: 12px;
            box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
        }

        .btn-register:hover, .btn-register:active {
            background-color: #15803d;
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

    </style>
</head>

<body>

<div class="app-card">

    <div class="logo">🏛️ eBarangay</div>
    <div class="subtitle">Create Resident Account</div>

    <form method="POST" action="/register">
        @csrf

        <!-- Personal Info -->
        <div class="section-label mt-0">Personal Information</div>

        <div class="input-group-custom">
            <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
        </div>

        <div class="input-group-custom">
            <input type="text" name="address" class="form-control" placeholder="Address" required>
        </div>

        <div class="input-group-custom">
            <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" required>
        </div>

        <!-- Account Info -->
        <div class="section-label">Account Details</div>

        <div class="input-group-custom">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
        </div>

        <div class="input-group-custom">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-register w-100 mt-2">Register</button>

    </form>

    <div class="link-container">
        <a href="/login" class="link">Back to Login</a>
    </div>

</div>

</body>
</html>