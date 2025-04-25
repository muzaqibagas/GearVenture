<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>GearVenture</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!-- partial:index.partial.html -->
<body style="background-image: url('{{ asset('img/night.gif') }}');">

    <section>
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <h1>Create a new account</h1>
            <div class="inputbox">
                <input type="text" class="form-control{{ $errors->has('nama')? 'is-invalid' : '' }}"
                    name="nama" required placeholder=" ">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Nama Lengkap</label>
            </div>

            <div class="inputbox">
                <input type="text" class="form-control{{ $errors->has('username')? 'is-invalid' : '' }}"
                    name="username" required placeholder=" ">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Username</label>
            </div>
            
            <div class="inputbox">
                <input type="email" class="form-control{{ $errors->has('email')? 'is-invalid' : '' }}"
                    name="email" required placeholder=" ">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Email</label>
            </div>

            <div class="inputbox">
                <input type="password" class="form-control{{ $errors->has('password')? 'is-invalid' : '' }}"
                    name="password" required placeholder=" ">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Password</label>
            </div>

            <div class="form-group" style="color:white !important;">
                <label>Jenis Kelamin:</label><br>

                <div style="display: flex !important; gap: 30px !important;">
                    <div>
                        <input type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki" checked required>
                        <label for="laki-laki">Laki-laki</label>
                    </div>
                    <div>
                        <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                        <label for="perempuan">Perempuan</label>
                    </div>                    
                </div>

                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="inputbox" hidden>
                <select class="form-control" name="role" required>
                    <option value="user" selected>User</option>
                </select>
            </div>



            <button type="submit">Register</button>
            <div class="register">
                <p>Already have an account? <a href="{{ route('signin') }}" class="text-white">Log in</a></p>
            </div>
        </form>

    </section>
</body>
<!-- partial -->
  
</body>
</html>
