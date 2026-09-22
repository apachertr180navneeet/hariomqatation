<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Hari Om Computer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <style>
        body {
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-box {
            width: 100%;
            max-width: 440px;
            padding: 36px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-3 mb-2" style="width: 52px; height: 52px; font-size: 1.6rem;">
                <i class="bi bi-cpu"></i>
            </div>
            <h3 class="fw-bold text-slate-900 mb-1">HARI OM COMPUTER</h3>
            <p class="text-muted small">Admin ERP & Sales Management Portal</p>
        </div>

        <!-- Status & Flash Message Alert -->
        @if (session('status'))
            <div class="alert alert-success border-0 small py-2 px-3 mb-3 rounded-3">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 small py-2 px-3 mb-3 rounded-3">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Demo Credentials Hint Alert -->
        <div class="alert alert-info border-0 small py-2 px-3 mb-4 rounded-3">
            <strong><i class="bi bi-info-circle-fill me-1"></i> Default Admin Credentials:</strong><br>
            Email: <code class="text-primary fw-bold">admin@hariomcomputer.com</code><br>
            Password: <code class="text-primary fw-bold">password</code>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-slate-700" for="login-email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="email" id="login-email" class="form-control border-start-0 @error('email') is-invalid @enderror" required value="{{ old('email', 'admin@hariomcomputer.com') }}" autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label small fw-bold text-slate-700" for="login-password">Password</label>
                    <span class="small text-muted">Default: <code>password</code></span>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                    <input type="password" name="password" id="login-password" class="form-control border-start-0 @error('password') is-invalid @enderror" required value="password">
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" value="1" {{ old('remember', true) ? 'checked' : '' }}>
                <label class="form-check-label small text-muted" for="rememberMe">Remember my login session</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Admin Panel
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Return to Store Frontend
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
