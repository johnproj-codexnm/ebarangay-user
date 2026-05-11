<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EBARANG-AY Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8; /* Flat background */
            padding-bottom: 80px;
            margin: 0;
            color: #0f172a;
        }

        .container {
            max-width: 480px; /* Mobile app width constraint */
            padding: 16px;
            margin: 0 auto;
        }

        .header {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 24px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }   

        .welcome {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .subtext {
            font-size: 0.9rem;
            color: #64748b;
        }

        .app-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .announcement-item {
            padding: 16px;
            background-color: #f8fafc;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
        }

        .announcement-item:last-child {
            margin-bottom: 0;
        }

        .announcement-title {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .announcement-content {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .announcement-date {
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .action-btn {
            border-radius: 16px;
            padding: 18px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            display: block;
            text-decoration: none;
            transition: transform 0.1s ease, box-shadow 0.2s ease;
        }
        
        .action-btn:active {
            transform: scale(0.98);
        }

        .btn-complaint {
            background-color: #2563eb; /* Primary Blue */
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        
        .btn-complaint:hover { color: #ffffff; background-color: #1d4ed8; }

        .btn-tickets {
            background-color: #ffffff;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        
        .btn-tickets:hover { color: #0f172a; background-color: #f8fafc; }

        .btn-logout {
            background-color: #fee2e2;
            color: #b91c1c;
            border-radius: 16px;
            padding: 16px;
            font-weight: 600;
            border: none;
        }
        
        .btn-logout:hover { background-color: #fecaca; }

        .project-logo {
            width: auto;
            max-width: 200px;
            max-height: 80px;
            object-fit: contain;
        }

        .brgy-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .brgy-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .ebarangay-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 1px;
            margin: 0;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- Branding -->
    <div class="branding text-center mt-2 mb-4">
        <img src="{{ asset('images/project-logo.png') }}" alt="Project Logo" class="project-logo mb-1">
        <h2 class="ebarangay-title mb-2">EBARANG-AY</h2>
        <div class="d-flex align-items-center justify-content-center gap-2">
            <img src="{{ asset('images/umingan-logo.png') }}" alt="San Leon Logo" class="brgy-logo">
            <h6 class="brgy-name">BARANGAY SAN LEON</h6>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="welcome">
            👋 Welcome, {{ session('resident_name') }}
        </div>
        <div class="subtext">
            Manage your requests and stay updated
        </div>
    </div>

    <!-- Announcements -->
    <div class="app-card">
        <div class="section-title">
            <span style="font-size: 1.2rem;">📢</span> Announcements
        </div>

        @forelse($announcements as $ann)
            <div class="announcement-item">
                <div class="announcement-title">{{ $ann['title'] }}</div>
                <div class="announcement-content">{{ $ann['content'] }}</div>
                <div class="announcement-date">{{ \Carbon\Carbon::parse($ann['created_at'])->format('F j, Y, g:i A') }}</div>
            </div>
        @empty
            <div class="announcement-item text-center" style="background: transparent; border: none;">
                <p class="text-muted mb-0">No announcements yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Actions -->
    <div class="d-grid gap-3">

        <a href="/submit-complaint" class="action-btn btn-complaint text-center">
            📝 Submit Complaint
        </a>

        <a href="/tickets" class="action-btn btn-tickets text-center">
            🎫 View My Tickets
        </a>

        <a href="/logout" class="btn btn-logout w-100 mt-2">
            Logout
        </a>

    </div>

</div>

</body>

</html>