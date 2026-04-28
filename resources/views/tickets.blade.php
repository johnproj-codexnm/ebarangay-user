<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #0f172a;
            margin: 0;
            padding-bottom: 40px;
        }
        
        .container {
            max-width: 480px; /* Mobile width */
            padding: 16px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-top: 8px;
        }

        .title {
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
            flex-grow: 1;
        }

        .back-btn-top {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #0f172a;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        /* App Card */
        .app-card {
            background-color: #ffffff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            overflow: hidden; /* For image */
            transition: transform 0.1s ease;
            margin-bottom: 16px;
        }

        .app-card:active {
            transform: scale(0.98);
        }

        .card-body-custom {
            padding: 20px;
        }

        /* Image styling */
        .ticket-img {
            height: 140px; 
            width: 100%; 
            object-fit: cover;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Text */
        .text-soft {
            color: #64748b;
        }

        /* Status Badges */
        .status-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-processing {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .badge-resolved {
            background-color: #dcfce3;
            color: #16a34a;
        }

        /* Buttons */
        .btn-primary-app {
            background-color: #2563eb;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 600;
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .btn-danger-app {
            background-color: #fee2e2;
            color: #b91c1c;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        
    </style>
</head>

<body>

<div class="container mt-2">

    <div class="header">
        <a href="/dashboard" class="back-btn-top">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h4 class="title">My Tickets</h4>
    </div>

    @forelse($tickets as $ticket)

        <div class="app-card">

            @if($ticket['preview_image'])
                <img 
                src="https://sgp.cloud.appwrite.io/v1/storage/buckets/{{ env('APPWRITE_BUCKET_ID') }}/files/{{ $ticket['preview_image'] }}/view?project={{ env('APPWRITE_PROJECT_ID') }}&mode=admin"
                class="ticket-img">
            @endif

            <div class="card-body-custom">
                <h5 class="fw-bold mb-1" style="font-size: 1.1rem; color: #0f172a;">{{ $ticket['title'] }}</h5>

                <p class="text-soft small mb-3 fw-medium">
                    {{ $ticket['category'] }}
                </p>

                <div class="d-flex justify-content-between align-items-center gap-2 mt-2">

                    @php
                        $status = strtolower($ticket['status']);
                    @endphp

                    <span class="status-badge 
                        @if($status == 'pending') badge-pending
                        @elseif($status == 'processing') badge-processing
                        @elseif($status == 'resolved') badge-resolved
                        @endif
                    ">
                        {{ ucfirst($ticket['status']) }}
                    </span>

                    <div class="d-flex gap-2">

                        <a href="/ticket/{{ $ticket['$id'] }}" class="btn btn-primary-app">
                            Open
                        </a>

                        <form method="POST" action="/delete-ticket" onsubmit="return confirm('Delete this ticket?')" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ticket['$id'] }}">
                            <button type="submit" class="btn btn-danger-app">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>

    @empty

        <div class="app-card p-5 text-center mt-4">
            <p class="mb-0 text-soft fw-medium">No tickets submitted yet.</p>
        </div>

    @endforelse

</div>

</body>
</html>