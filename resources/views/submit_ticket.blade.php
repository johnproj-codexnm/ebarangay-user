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
    
    <!-- Exifr for EXIF parsing -->
    <script src="https://cdn.jsdelivr.net/npm/exifr/dist/lite.umd.js"></script>

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

        /* Location Selection Styles */
        .btn-mode {
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .btn-mode.active {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        .btn-mode.inactive {
            background-color: #f8fafc;
            color: #64748b;
            border-color: #e2e8f0;
        }

        #toast-container {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10000;
            display: none;
            background-color: #334155;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

    </style>
</head>

<body>

<!-- Toast Notification -->
<div id="toast-container"></div>

<!-- Submit Overlay -->
<div id="submitOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #ffffff; z-index: 9999; flex-direction: column; align-items: center; justify-content: center;">
    <img src="{{ asset('images/project-logo.png') }}" alt="Project Logo" style="width: auto; max-width: 200px; max-height: 80px; margin-bottom: 24px;">
    
    <div style="width: 80%; max-width: 300px;">
        <div style="text-align: center; margin-bottom: 8px; font-weight: 600; color: #475569;">Submitting... <span id="progressText">0%</span></div>
        <div class="progress" style="height: 12px; border-radius: 6px; background-color: #f1f5f9; overflow: hidden;">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%; transition: width 0.2s ease;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>

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

        <form id="complaintForm" method="POST" action="/submit-complaint" enctype="multipart/form-data">
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

            <!-- Location Source -->
            <div class="mb-4">
                <div class="section-label">LOCATION SOURCE</div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-mode active flex-grow-1" id="btnCurrentMode">Current</button>
                    <button type="button" class="btn btn-mode inactive flex-grow-1" id="btnMetadataMode">Metadata</button>
                </div>
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

let locationMode = 'current';
let currentLocationString = '';

document.getElementById('btnCurrentMode').addEventListener('click', function() {
    locationMode = 'current';
    this.classList.replace('inactive', 'active');
    document.getElementById('btnMetadataMode').classList.replace('active', 'inactive');
});

document.getElementById('btnMetadataMode').addEventListener('click', function() {
    locationMode = 'metadata';
    this.classList.replace('inactive', 'active');
    document.getElementById('btnCurrentMode').classList.replace('active', 'inactive');
});

function showToast(message) {
    let toast = document.getElementById('toast-container');
    toast.innerText = message;
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 4000);
}

function getLocation(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;
            currentLocationString = `https://maps.google.com/?q=${lat},${lng}`;
            document.getElementById("locationInput").value = currentLocationString;
        }, function(error){
            console.log("Location error:", error);
        });
    }else{
        console.log("Geolocation not supported");
    }
}

// Run automatically when page loads
getLocation();

function submitData(form, submitBtn) {
    const formData = new FormData(form);
    
    // Show overlay
    document.getElementById('submitOverlay').style.display = 'flex';
    
    const xhr = new XMLHttpRequest();
    xhr.open(form.method, form.action, true);
    
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percentComplete = Math.round((e.loaded / e.total) * 100);
            document.getElementById('progressBar').style.width = percentComplete + '%';
            document.getElementById('progressText').innerText = percentComplete + '%';
        }
    };
    
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            document.getElementById('progressBar').style.width = '100%';
            document.getElementById('progressText').innerText = '100%';
            
            setTimeout(() => {
                if (xhr.responseURL) {
                    window.location.href = xhr.responseURL;
                } else {
                    window.location.href = '/dashboard';
                }
            }, 500); 
        } else {
            alert('An error occurred while submitting.');
            document.getElementById('submitOverlay').style.display = 'none';
            submitBtn.disabled = false;
        }
    };
    
    xhr.onerror = function() {
        alert('A network error occurred.');
        document.getElementById('submitOverlay').style.display = 'none';
        submitBtn.disabled = false;
    };
    
    xhr.send(formData);
}

document.getElementById('complaintForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = this;
    const submitBtn = form.querySelector('.submit-btn');
    submitBtn.disabled = true;
    
    if (locationMode === 'metadata') {
        const fileInput = document.querySelector('input[name="image"]');
        if (fileInput && fileInput.files.length > 0) {
            try {
                let tags = await exifr.gps(fileInput.files[0]);
                if (tags && tags.latitude && tags.longitude) {
                    // Condition Alpha: Success
                    document.getElementById("locationInput").value = `https://maps.google.com/?q=${tags.latitude},${tags.longitude}`;
                    submitData(form, submitBtn);
                } else {
                    // Condition Beta: Missing coords
                    showToast("No location data found in photo. Defaulting to your current location.");
                    document.getElementById("locationInput").value = currentLocationString; // Fallback
                    setTimeout(() => submitData(form, submitBtn), 2500); // Wait so user reads toast
                }
            } catch (err) {
                // Condition Beta: Error parsing
                showToast("Error parsing photo metadata. Defaulting to your current location.");
                document.getElementById("locationInput").value = currentLocationString; // Fallback
                setTimeout(() => submitData(form, submitBtn), 2500); 
            }
        } else {
            // No photo uploaded
            showToast("No photo uploaded. Defaulting to your current location.");
            document.getElementById("locationInput").value = currentLocationString; // Fallback
            setTimeout(() => submitData(form, submitBtn), 2500);
        }
    } else {
        // Current Location Mode
        document.getElementById("locationInput").value = currentLocationString;
        submitData(form, submitBtn);
    }
});

</script>

</html>