<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SIMS PPOB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="flex w-3/4 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Form Registrasi -->
        <div class="w-1/2 flex flex-col justify-center p-10">
            <div class="flex items-center justify-center mb-4">
                <img src="<?= base_url('images/Logo.png') ?>" alt="Logo" class="w-8 h-8">
                <h2 class="text-xl font-bold ml-2">SIMS PPOB</h2>
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Lengkapi data untuk membuat akun</h2>
            <form id="registerForm">
                <div class="mb-4">
                    <input type="email" class="w-full p-3 border rounded" placeholder="📧 masukan email anda" required>
                </div>
                <div class="mb-4">
                    <input type="text" class="w-full p-3 border rounded" placeholder="👤 nama depan" required>
                </div>
                <div class="mb-4">
                    <input type="text" class="w-full p-3 border rounded" placeholder="👤 nama belakang" required>
                </div>
                <div class="mb-4 relative">
                    <input type="password" class="w-full p-3 border rounded" placeholder="🔒 buat password" required>
                </div>
                <div class="mb-4 relative">
                    <input type="password" class="w-full p-3 border rounded" placeholder="🔒 konfirmasi password" required>
                </div>
                <button type="submit" class="w-full bg-red-500 text-white p-3 rounded">Registrasi</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">Sudah punya akun? <a href="login.html" class="text-red-500">Login di sini</a></p>
        </div>
        
        <!-- Ilustrasi -->
        <div class="w-1/2 bg-pink-100 flex items-center justify-center">
            <img src="<?= base_url('images/Illustrasi-Login.png') ?>" alt="Illustrasi" class="max-h-100">
        </div>
    </div>
</body>
</html>