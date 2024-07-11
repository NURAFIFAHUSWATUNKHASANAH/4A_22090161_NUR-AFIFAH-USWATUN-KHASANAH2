<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Pengguna</title>
</head>
<body>
    <div>
        <h2>Kelola Akun</h2>
        <div>
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <form action="{{ route('change.password') }}" method="POST">
            @csrf
            <div>
                <label for="password">Ubah Kata Sandi:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="password_confirmation">Konfirmasi Kata Sandi Baru:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
