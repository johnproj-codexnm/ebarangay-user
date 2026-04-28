<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Submit Complaint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8;
            padding-bottom: 80px;
            margin: 0;
            color: #0f172a;
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

        .title-group {
            flex-grow: 1;
        }

        .title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 0.85rem;
            color: #64748b;
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

        .app-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 24px 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 8px;
            margin-left: 4px;
            text-transform: uppercase;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 1rem;
            color: #0f172a;
            box-shadow: none;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        
        .form-control::placeholder {
            color: #94a3b8;
        }

        textarea.form-control {
            resize: none;
        }

        .file-upload {
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            background-color: #f8fafc;
            color: #64748b;
            transition: border-color 0.2s ease;
        }
        
        .file-upload:hover {
            border-color: #94a3b8;
        }

        .file-upload input {
            border: none;
            background: transparent;
            font-size: 0.9rem;
            width: 100%;
        }

        .submit-btn {
            border-radius: 12px;
            padding: 16px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            font-weight: 600;
            font-size: 1.05rem;
            margin-top: 12px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            transition: background-color 0.2s ease;
        }
        
        .submit-btn:focus, .submit-btn:hover {
            background-color: #1d4ed8;
            color: white;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <a href="/dashboard" class="back-btn-top">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <div class="title-group">
            <div class="title">Submit Complaint</div>
            <div class="subtitle">Report an issue to your barangay</div>
        </div>
    </div>

    <!-- Form -->
    <div class="app-card">

        <form method="POST" action="/submit-complaint" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <div class="section-label">TITLE</div>
                <input type="text" name="title" class="form-control" placeholder="Enter complaint title" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <div class="section-label">DESCRIPTION</div>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe the issue in detail..." required></textarea>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <div class="section-label">CATEGORY</div>
                <select name="category" class="form-select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat['name'] }}">
                            {{ $cat['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- File Upload -->
            <div class="mb-3">
                <div class="section-label">ATTACH PHOTO (OPTIONAL)</div>
                <div class="file-upload">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <input type="hidden" name="location" id="locationInput">

            <!-- Submit -->
            <button class="btn submit-btn w-100">
                Submit Complaint
            </button>

        </form>

    </div>

</div>

</body>

<script>

function getLocation(){

if(navigator.geolocation){

navigator.geolocation.getCurrentPosition(function(position){

let lat = position.coords.latitude;
let lng = position.coords.longitude;

// Convert to Google Maps link
let mapLink = `https://maps.google.com/?q=${lat},${lng}`;

document.getElementById("locationInput").value = mapLink;

}, function(error){

console.log("Location error:", error);

});

}else{
console.log("Geolocation not supported");
}

}

// Run automatically when page loads
getLocation();

</script>

</html>