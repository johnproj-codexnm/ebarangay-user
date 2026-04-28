<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eBarangay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #0f172a;
        }

        .splash-container {
            width: 100%;
            max-width: 400px;
            padding: 40px 24px;
            text-align: center;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px auto;
            font-size: 2.5rem;
        }

        .app-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .app-desc {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 48px;
            line-height: 1.5;
        }

        .btn-primary-app {
            background-color: #2563eb;
            color: #ffffff;
            border-radius: 12px;
            padding: 16px;
            font-weight: 600;
            font-size: 1.05rem;
            width: 100%;
            border: none;
            display: block;
            text-decoration: none;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }

        .btn-primary-app:hover {
            background-color: #1d4ed8;
            color: #ffffff;
        }

        .btn-secondary-app {
            background-color: #f8fafc;
            color: #0f172a;
            border-radius: 12px;
            padding: 16px;
            font-weight: 600;
            font-size: 1.05rem;
            width: 100%;
            border: 1px solid #e2e8f0;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-secondary-app:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
    </style>
</head>
<body>

    <div class="splash-container">
        
        <div class="icon-circle">🏛️</div>
        
        <h1 class="app-title">eBarangay</h1>
        <p class="app-desc">Welcome to your modern barangay resident portal. Fast, easy, and reliable.</p>

        @auth
            <a href="{{ url('/dashboard') }}" class="btn-primary-app">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn-primary-app">Log In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-secondary-app">Create Account</a>
            @endif
        @endauth

    </div>

</body>
</html>
