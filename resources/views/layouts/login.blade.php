<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            background: linear-gradient(to right, #007bff, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .auth-box {
            background: #fff;
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 400px;
        }

        .auth-box h4 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #333;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6610f2;
        }

        .btn-primary {
            background-color: #6610f2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #520dc2;
        }
    </style>
</head>
<body>

    <div class="auth-box">
        @yield('content')
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
