<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMS PPOB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="flex w-3/4 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Form Login -->
        <div class="w-1/2 flex flex-col justify-center p-10">
            <div class="flex items-center justify-center mb-4">
                <img src="<?= base_url('images/Logo.png') ?>" alt="Logo" class="h-8 mr-2">
                <h2 class="text-2xl font-bold">SIMS PPOB</h2>
            </div>
            <p class="text-center text-gray-600 mb-6">Masuk atau buat akun untuk memulai</p>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" class="w-full p-2 pl-10 border rounded" placeholder="masukan email anda" required>
                        <span class="absolute left-3 top-3 text-gray-500">📧</span>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full p-2 pl-10 border rounded" placeholder="masukan password anda" required>
                        <span class="absolute left-3 top-3 text-gray-500">🔒</span>
                    </div>
                </div>
                <button type="submit" class="w-full bg-red-500 text-white p-2 rounded">Masuk</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">Belum punya akun? <a href="register.html" class="text-red-500">Registrasi di sini</a></p>
        </div>
        
        <!-- Ilustrasi -->
        <div class="w-1/2 bg-pink-100 flex items-center justify-center">
            <img src="<?= base_url('images/Illustrasi-Login.png') ?>" alt="Illustrasi" class="max-h-100">
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#loginForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "http://localhost:8080/api/login", // 🔥 Pastikan ke CodeIgniter, bukan API eksternal
            contentType: "application/json", // 🔥 Pastikan data dikirim sebagai JSON
            data: JSON.stringify({
                email: $("#email").val(),
                password: $("#password").val()
            }),
            dataType: "json",
            success: function (response) {
                console.log("Response dari server:", response);
                alert(response.message);

                if (response.status === "success") {
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR) {
                console.log("Error:", jqXHR.responseText);
                alert("Gagal login: " + jqXHR.responseText);
            }
        });
    });
});

</script>

</body>
</html>
