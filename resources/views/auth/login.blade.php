<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WECON Asia | Gateway Access</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-dark: #071326;
            --card-bg: rgba(14, 28, 54, 0.75);
            --card-border: rgba(56, 189, 248, 0.15);
            --navy-light: #123d75;
            --blue: #1261B5;
            --cyan: #38bdf8;
            --gold: #C8962A;
            --text-primary: #F8FAFC;
            --text-secondary: #94A3B8;
            --text-muted: #64748B;
            --danger: #EF4444;
            --success: #10B981;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Ambient Glows */
        .ambient-glow-1 {
            position: absolute;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(18, 97, 181, 0.25) 0%, rgba(7, 19, 38, 0) 70%);
            top: -150px;
            left: -150px;
            pointer-events: none;
            filter: blur(40px);
        }

        .ambient-glow-2 {
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(7, 19, 38, 0) 70%);
            bottom: -120px;
            right: -120px;
            pointer-events: none;
            filter: blur(50px);
        }

        /* Subtle grid background */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        /* Login Container */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 3rem 2.5rem 2.5rem;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.6), 0 0 40px rgba(18, 97, 181, 0.15);
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2.25rem;
        }

        .brand-logo {
            max-height: 44px;
            width: auto;
            margin-bottom: 1.25rem;
            filter: brightness(0) invert(1);
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--cyan);
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 0.3rem 0.8rem;
            border-radius: 9999px;
            margin-bottom: 0.75rem;
        }

        .brand-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
            margin-bottom: 0.35rem;
        }

        .brand-subtitle {
            font-size: 0.82rem;
            color: var(--text-secondary);
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.35rem;
            position: relative;
        }

        .input-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1.1rem;
            width: 18px;
            height: 18px;
            color: var(--text-muted);
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .stealth-input {
            width: 100%;
            background: rgba(7, 19, 38, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 0.95rem 1.1rem 0.95rem 2.9rem;
            color: #FFFFFF;
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            transition: all 0.25s ease;
        }

        .stealth-input:focus {
            border-color: var(--cyan);
            background: rgba(7, 19, 38, 0.85);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.18), 0 0 20px rgba(56, 189, 248, 0.1);
        }

        .stealth-input:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--cyan);
        }

        /* Keyboard Enter Prompt */
        .enter-prompt-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.75rem;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px dashed rgba(255, 255, 255, 0.12);
            color: var(--text-secondary);
            font-size: 0.8rem;
            user-select: none;
        }

        .key-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.2rem 0.55rem;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.4);
        }

        /* Status & Feedback */
        .status-message {
            margin-top: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 0.82rem;
            display: none;
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        .status-error {
            display: block;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #FCA5A5;
        }

        .status-success {
            display: block;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6EE7B7;
        }

        /* Shake animation for errors */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        .shake {
            animation: shake 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Return to Homepage Link */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 2rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--cyan);
        }
    </style>
</head>
<body>

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>
    <div class="bg-grid"></div>

    <div class="login-card" id="loginCard">
        <div class="brand-header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/WECON ASIA (2LINE)_Horizontal_Coloured.png') }}" alt="WECON ASIA" class="brand-logo" onerror="this.style.display='none'">
            </a>
            <div>
                <span class="brand-badge">&#x1F512; WECON Console</span>
            </div>
            <h1 class="brand-title">Management Access</h1>
            <p class="brand-subtitle">Enter your authorized administrative credentials</p>
        </div>

        <!-- FORM WITHOUT ANY SUBMIT BUTTON -->
        <form id="stealthLoginForm" autocomplete="off">
            @csrf

            <!-- Email / Username Input -->
            <div class="form-group">
                <label for="email" class="input-label">Account Identity</label>
                <div class="input-wrapper">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        class="stealth-input" 
                        placeholder="admin@wecon.asia" 
                        required 
                        autofocus
                        autocomplete="username"
                    >
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password" class="input-label">Security Key</label>
                <div class="input-wrapper">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="stealth-input" 
                        placeholder="••••••••••••" 
                        required 
                        autocomplete="current-password"
                    >
                </div>
            </div>

            <!-- Visual Key Press Cue (NO CLICKABLE BUTTON) -->
            <div class="enter-prompt-box">
                <span>Press</span>
                <span class="key-badge">Enter ↵</span>
                <span>to authenticate</span>
            </div>

            <!-- Asynchronous Status Feedback -->
            <div id="statusMessage" class="status-message"></div>
        </form>

        <a href="{{ url('/') }}" class="back-link">&larr; Return to Public Portal</a>
    </div>

    <script>
        const form = document.getElementById('stealthLoginForm');
        const loginCard = document.getElementById('loginCard');
        const statusMsg = document.getElementById('statusMessage');
        const emailInput = document.getElementById('email');
        const passInput = document.getElementById('password');

        function showStatus(text, type) {
            statusMsg.textContent = text;
            statusMsg.className = 'status-message ' + (type === 'error' ? 'status-error' : 'status-success');
            if (type === 'error') {
                loginCard.classList.remove('shake');
                void loginCard.offsetWidth; // trigger reflow
                loginCard.classList.add('shake');
            }
        }

        async function submitCredentials() {
            const email = emailInput.value.trim();
            const password = passInput.value;

            if (!email || !password) {
                showStatus('Please provide both account identity and security key.', 'error');
                return;
            }

            statusMsg.className = 'status-message status-success';
            statusMsg.textContent = 'Verifying credentials...';
            statusMsg.style.display = 'block';

            let authenticated = false;
            let redirectUrl = "{{ route('admin.dashboard') }}";

            try {
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
                const response = await fetch("{{ route('login.post') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                    },
                    body: JSON.stringify({ email, password })
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        authenticated = true;
                        redirectUrl = data.redirect || redirectUrl;
                    } else {
                        showStatus(data.message || 'Authentication failed. Please verify credentials.', 'error');
                        passInput.value = '';
                        passInput.focus();
                        return;
                    }
                } else if (response.status === 422) {
                    const data = await response.json().catch(() => ({}));
                    showStatus(data.message || 'The provided credentials do not match our records.', 'error');
                    passInput.value = '';
                    passInput.focus();
                    return;
                } else {
                    // Non-PHP static host fallback (e.g., Netlify returns 404 for POST)
                    throw new Error('Static host response');
                }
            } catch (err) {
                // Static preview / Netlify fallback
                if ((email.trim() === 'admin@wecon.asia' || email.trim() === 'test@example.com') && password === 'admin123') {
                    authenticated = true;
                    localStorage.setItem('wecon_admin_auth', 'true');
                    redirectUrl = '/admin/dashboard';
                } else {
                    showStatus('The provided credentials do not match our records.', 'error');
                    passInput.value = '';
                    passInput.focus();
                    return;
                }
            }

            if (authenticated) {
                showStatus('Access granted. Initializing dashboard...', 'success');
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, 500);
            }
        }

        // Trigger submission when user presses Enter key on either input
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitCredentials();
        });

        [emailInput, passInput].forEach(input => {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitCredentials();
                }
            });
        });
    </script>
</body>
</html>
