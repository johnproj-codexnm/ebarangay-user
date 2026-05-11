<!DOCTYPE html>
<html>

<head>
    <title>Ticket Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            color: #0f172a;
            padding-bottom: 24px;
        }

        .container {
            max-width: 480px; /* Mobile app width constraint */
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
            flex-shrink: 0;
        }

        .app-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            background-color: #f1f5f9; /* default */
            color: #0f172a;
        }

        /* Message Bubbles */
        .chat-container {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 4px;
        }
        
        .chat-container::-webkit-scrollbar {
            width: 6px;
        }
        .chat-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }

        .msg-bubble {
            padding: 12px 16px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.95rem;
            max-width: 85%;
            word-wrap: break-word;
        }

        .msg-user {
            background-color: #2563eb;
            color: #ffffff;
            border-bottom-right-radius: 4px;
        }

        .msg-admin {
            background-color: #f1f5f9;
            color: #0f172a;
            border-bottom-left-radius: 4px;
        }

        .msg-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        /* Evidence Image */
        .evidence-img {
            max-height: 250px;
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            border: 1px solid #e2e8f0;
        }

        /* Form Input */
        .chat-input {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 14px 16px;
            background-color: #f8fafc;
            resize: none;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.2s;
        }

        .chat-input:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #ffffff;
        }

        .btn-send {
            border-radius: 12px;
            padding: 14px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.2s;
        }

        .btn-send:hover {
            background-color: #1d4ed8;
        }
        
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <a href="/tickets" class="back-btn-top">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h4 class="title">Ticket Details</h4>
    </div>

    <!-- Ticket Info -->
    <div class="app-card">
        <h5 class="fw-bold mb-2">{{ $ticket['title'] }}</h5>
        <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.5;">{{ $ticket['description'] }}</p>
        <span class="badge-status">{{ $ticket['status'] }}</span>
    </div>

    <!-- Evidence Section -->
    <div class="app-card">
        <h6 class="section-title">📷 Evidence</h6>
        @forelse($evidence as $img)
            <img 
            src="https://sgp.cloud.appwrite.io/v1/storage/buckets/{{ env('APPWRITE_BUCKET_ID') }}/files/{{ $img['image_id'] }}/view?project={{ env('APPWRITE_PROJECT_ID') }}&mode=admin"
            class="evidence-img"
            onclick="openImage(this.src)">
        @empty
            <p class="text-muted mb-0 small">No evidence uploaded</p>
        @endforelse
    </div>

    <!-- Conversation Section -->
    <div class="app-card" style="padding: 20px 16px;">
        <h6 class="section-title px-1">💬 Conversation</h6>
        
        <div id="messageBox" class="chat-container px-1">
            @forelse($messages as $msg)
                <div class="mb-3">
                    @if($msg['sender_role'] == 'resident')
                        <div class="text-end">
                            <div class="msg-label pe-1">You</div>
                            <div class="msg-bubble msg-user text-start">
                                {{ $msg['message'] }}
                            </div>
                        </div>
                    @else
                        <div class="text-start">
                            <div class="msg-label ps-1">Admin</div>
                            <div class="msg-bubble msg-admin">
                                {{ $msg['message'] }}
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted text-center" style="font-size:0.9rem;">No messages yet</p>
            @endforelse
        </div>
    </div>

    <!-- Message Form -->
    <div class="app-card">
        @if($ticket['status'] === 'Resolved')
            <div class="text-center text-muted" style="font-size: 0.95rem; font-weight: 500;">
                🔒 This ticket has been resolved. Messaging is disabled.
            </div>
        @else
            <form id="messageForm">
                @csrf
                <input type="hidden" id="complaint_id" value="{{ $ticket['$id'] }}">
                <textarea 
                    id="messageInput"
                    class="chat-input mb-3" 
                    rows="2"
                    placeholder="Type your message..." 
                    required></textarea>
                <button class="btn-send">
                    Send Message
                </button>
            </form>
        @endif
    </div>

</div>

<!-- Image Preview Modal -->
<div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(15, 23, 42, 0.95); justify-content:center; align-items:center; z-index:9999;">
    <img id="modalImg" style="max-width:90%; max-height:90%; border-radius:16px;">
</div>

<script>
let complaintId = "{{ $ticket['$id'] }}";

function openImage(src){
    document.getElementById('imageModal').style.display = 'flex';
    document.getElementById('modalImg').src = src;
}

document.getElementById('imageModal').onclick = function(){
    this.style.display = 'none';
}

function loadMessages(){
    fetch("/messages/" + complaintId)
    .then(res => res.json())
    .then(data => {
        let box = document.getElementById("messageBox");
        box.innerHTML = "";

        if(data.length === 0){
            box.innerHTML = "<p class='text-muted text-center' style='font-size:0.9rem;'>No messages yet</p>";
            return;
        }

        data.forEach(msg => {
            let div = document.createElement("div");
            div.classList.add("mb-3");

            if(msg.sender_role === "resident"){
                div.innerHTML = `
                <div class="text-end">
                    <div class="msg-label pe-1">You</div>
                    <div class="msg-bubble msg-user text-start">
                        ${msg.message}
                    </div>
                </div>
                `;
            }else{
                div.innerHTML = `
                <div class="text-start">
                    <div class="msg-label ps-1">Admin</div>
                    <div class="msg-bubble msg-admin">
                        ${msg.message}
                    </div>
                </div>
                `;
            }
            box.appendChild(div);
        });

        box.scrollTop = box.scrollHeight;
    });
}

let msgForm = document.getElementById("messageForm");
if(msgForm) {
    msgForm.addEventListener("submit", function(e){
        e.preventDefault();
        let message = document.getElementById("messageInput").value;

        if(!message.trim()) return;

        fetch("/send-message", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                complaint_id: complaintId,
                message: message
            })
        })
        .then(() => {
            document.getElementById("messageInput").value = "";
            loadMessages();
        });
    });
}

setInterval(loadMessages, 3000);
loadMessages();

</script>
</body>
</html>