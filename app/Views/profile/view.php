<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function enableEditing() {
            document.getElementById('first_name').removeAttribute('readonly');
            document.getElementById('last_name').removeAttribute('readonly');
            document.getElementById('editBtn').classList.add('hidden');
            document.getElementById('saveCancelBtns').classList.remove('hidden');
        }

        function disableEditing() {
            document.getElementById('first_name').setAttribute('readonly', true);
            document.getElementById('last_name').setAttribute('readonly', true);
            document.getElementById('editBtn').classList.remove('hidden');
            document.getElementById('saveCancelBtns').classList.add('hidden');
        }

        function updateProfile() {
            alert("Profil berhasil diperbarui!");
            disableEditing();
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file && file.size <= 100000) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Ukuran gambar maksimal 100 KB!");
            }
        }
    </script>
</head>
<body class="bg-white-100">
  
    <!-- Navbar -->
    <div class="navbar flex justify-between bg-white-800 p-4 text-black">
        <div class="flex items-center">
            <img src="<?= base_url('images/Logo.png') ?>" alt="Logo" class="h-8 mr-2"> 
            <strong class="text-lg">HIS PPOB</strong>
        </div>
        <div class="flex space-x-4">
            <a href="<?= base_url('topup'); ?>" class="hover:underline">Top Up</a>
            <a href="<?= base_url('history'); ?>" class="hover:underline">Transaksi</a>
            <a href="<?= base_url('profile'); ?>" class="hover:underline">Akun</a>
        </div>
    </div>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg text-center">
        <div class="relative w-24 h-24 mx-auto">
            <img id="profile-img" src="<?= base_url('images/Profile Photo.png') ?>"  alt="Profile" class="w-24 h-24 rounded-full mx-auto">
            <input type="file" id="imageUpload" class="hidden" accept="image/*" onchange="previewImage(event)">
            <button onclick="document.getElementById('imageUpload').click()" class="absolute bottom-0 right-0 bg-gray-300 p-2 rounded-full">✎</button>
        </div>
        <h2 class="text-2xl font-semibold mt-2">Kristanto Wibowo</h2>

        <form class="mt-6">
            <label class="block text-left text-gray-700">Email</label>
            <input type="email" class="w-full p-2 border rounded bg-gray-200" value="wallet@nutech.com" readonly>

            <label class="block text-left text-gray-700 mt-4">Nama Depan</label>
            <input type="text" id="first_name" class="w-full p-2 border rounded" value="Kristanto" readonly>

            <label class="block text-left text-gray-700 mt-4">Nama Belakang</label>
            <input type="text" id="last_name" class="w-full p-2 border rounded" value="Wibowo" readonly>

            <button type="button" id="editBtn" class="w-full bg-blue-500 text-white p-2 rounded mt-6" onclick="enableEditing()">Edit Profile</button>
            <div id="saveCancelBtns" class="hidden">
                <button type="button" class="w-full bg-green-500 text-white p-2 rounded mt-6" onclick="updateProfile()">Simpan</button>
                <button type="button" class="w-full bg-gray-500 text-white p-2 rounded mt-2" onclick="disableEditing()">Batalkan</button>
            </div>
            <button class="w-full bg-red-500 text-white p-2 rounded mt-6">Logout</button>
        </form>
    </div>
</body>
</html>
