<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gallspace Auth</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

body {
    background: #000;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.logo {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 120px;
}

.auth-container {
    background: #1e1e1e;
    width: 360px;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(255,255,255,0.05);
}

.form { display: none; }
.form.active { display: block; }

.input-group { margin-bottom: 15px; }

.input-group input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    background: #333;
    color: #fff;
}

button {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    background: #444;
    color: #fff;
}

button:hover { opacity: 0.8; }

.switch-text {
    text-align: center;
    margin-top: 15px;
    font-size: 12px;
}

.switch-text span {
    cursor: pointer;
    text-decoration: underline;
}

.alert {
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.success-alert {
    background: #1f3d1f;
    color: #4CAF50;
}

.error-alert {
    background: #3d1f1f;
    color: #ff4d4d;
}

.alert span {
    cursor: pointer;
    font-weight: bold;
}
</style>
</head>
<body>

<img src="{{ asset('logo/logo.png') }}" class="logo">

<h1>GALLSPACE</h1>
<p style="margin-bottom:40px;">Login untuk mengakses sistem Gallspace</p>

<div class="auth-container">

    {{-- ================= LOGIN ================= --}}
    <form method="POST" action="{{ route('login') }}" 
          id="loginForm" class="form {{ old('name') ? '' : 'active' }}">
        @csrf

        <h2 style="text-align:center;margin-bottom:20px;">Login</h2>

        @if(session('success'))
            <div class="alert success-alert">
                {{ session('success') }}
                <span onclick="closeAlert(this)">×</span>
            </div>
        @endif

        @if($errors->any() && !old('name'))
            <div class="alert error-alert">
                {{ $errors->first() }}
                <span onclick="closeAlert(this)">×</span>
            </div>
        @endif

        <div class="input-group">
            <input type="email" name="email" 
                   placeholder="Email"
                   value="{{ old('email') }}" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" 
                   placeholder="Password" required>
        </div>

        <button type="submit">Login</button>

        <div class="switch-text">
            Belum punya akun? 
            <span onclick="showRegister()">Daftar</span>
        </div>
    </form>


    {{-- ================= REGISTER ================= --}}
    <form method="POST" action="{{ route('register') }}" 
          id="registerForm" class="form {{ old('name') ? 'active' : '' }}">
        @csrf

        <h2 style="text-align:center;margin-bottom:20px;">Register</h2>

        @if($errors->any() && old('name'))
            <div class="alert error-alert">
                {{ $errors->first() }}
                <span onclick="closeAlert(this)">×</span>
            </div>
        @endif

        <div class="input-group">
            <input type="text" name="name" 
                   placeholder="Nama"
                   value="{{ old('name') }}" required>
        </div>

        <div class="input-group">
            <input type="email" name="email" 
                   placeholder="Email"
                   value="{{ old('email') }}" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" 
                   placeholder="Password" required>
        </div>

        <div class="input-group">
            <input type="password" name="password_confirmation" 
                   placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit">Daftar</button>

        <div class="switch-text">
            Sudah punya akun? 
            <span onclick="showLogin()">Login</span>
        </div>
    </form>

</div>

<script>
function showRegister() {
    document.getElementById('loginForm').classList.remove('active');
    document.getElementById('registerForm').classList.add('active');
}

function showLogin() {
    document.getElementById('registerForm').classList.remove('active');
    document.getElementById('loginForm').classList.add('active');
}

function closeAlert(el) {
    el.parentElement.style.display = 'none';
}
</script>

</body>
</html>
