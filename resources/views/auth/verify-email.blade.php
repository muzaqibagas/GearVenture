<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>GearVenture</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!-- partial:index.partial.html -->
<body style="background-image: url('{{ asset('img/night.gif') }}');">

    <section>
    <h1>Email Verifikasi Telah Dikirim</h1>

    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Kirim ulang link verifikasi</button>
    </form>

    </section>
</body>
<!-- partial -->
  
</body>
</html>
