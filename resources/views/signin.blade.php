<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>GearVenture</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!-- partial:index.partial.html -->
<body style="background-image: url('{{ asset('img/night.gif') }}');">

    <section>
        @if ($message = Session::get('success')) 
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif   
        <form action="{{ route('signin') }}" method="post">
    @csrf
    <h1>Login</h1>
    <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="text" required placeholder=" " name="username">
        <label for="">Username</label>
    </div>
    <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input type="password" required placeholder=" " name="password">
        <label for="">Password</label>
    </div>
    <button type="submit">Log in</button>
    <div class="register">
        <p>Don't have an account? <a href="{{ route('signup.form') }}">Register</a></p>
    </div>
</form>

    </section>
</body>
<!-- partial -->
  
</body>
</html>
