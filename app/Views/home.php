<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage HIS-PPOB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }
        .navbar img {
            width: 30px;
            height: auto;
        }
        .menu a {
            text-decoration: none;
            color: #555;
            margin: 0 10px;
            font-size: 14px;
        }
        .menu a:hover {
            color: black;
        }
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: left;
        }
        .profile-container img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        .saldo-container {
            background: red;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 15px;
            padding: 15px;
            text-align: center;
        }
        .promo-container {
            text-align: center;
            padding: 20px;
        }
        .promo-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <img src="<?= base_url('images/Logo.png') ?>" alt="Logo"> <strong style="font-size: 14px;">HIS PPOB</strong>
        </div>
        <div class="menu">
            <a href="<?= base_url('topup'); ?>">Top Up</a>
            <a href="<?= base_url('history'); ?>">Transaksi</a>
            <a href="<?= base_url('profile'); ?>">Akun</a>
        </div>
    </div>
    
    <div class="dashboard-container">
        <div class="profile-container">
            <img src="<?= base_url('images/Profile Photo.png') ?>"  alt="Avatar">
            <p>Selamat datang,</p>
            <h2 id="user-name">Loading...</h2>
        </div>
        <div class="saldo-container">
            <p>Saldo Anda</p>
            <h2 id="saldo-amount">Rp ••••••••</h2>
            <button onclick="toggleSaldo()">Lihat Saldo</button>
        </div>
    </div>

    <div class="grid" id="services-container">
        <p>Loading layanan...</p>
    </div>

    <div class="promo-container">
        <h3>Promo Menarik</h3>
        <div class="promo-wrapper" id="promo-container">
            <p>Loading promo...</p>
        </div>
    </div>

    <script>
        const token = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzZXJAbnV0ZWNoLWludGVncmFzaS5jb20iLCJtZW1iZXJDb2RlIjoiTExLUjZKTDEiLCJpYXQiOjE3NDE5NjkxMzUsImV4cCI6MTc0MjAxMjMzNX0.Edh9Y6Ohwj9M2JvSwZMyJALUAo449Qqt2pEBlkrUn_I';
        
        function fetchData(url, callback) {
            fetch(url, { headers: { 'Authorization': token } })
            .then(res => res.json())
            .then(data => {
                if (data.status === 0) {
                    callback(data.data);
                } else {
                    console.error('API Error:', data.message);
                }
            })
            .catch(error => console.error('Fetch Error:', error));
        }

        function fetchSaldo() {
            fetchData('https://take-home-test-api.nutech-integrasi.com/balance', data => {
                document.getElementById('saldo-amount').textContent = `Rp ${data.balance}`;
            });
        }

        function toggleSaldo() {
            let saldoElement = document.getElementById('saldo-amount');
            if (saldoElement.textContent.includes('•')) {
                fetchSaldo();
            } else {
                saldoElement.textContent = "Rp ••••••••";
            }
        }

        fetchData('https://take-home-test-api.nutech-integrasi.com/profile', data => {
            document.getElementById('user-name').textContent = data.name;
        });

        fetchData('https://take-home-test-api.nutech-integrasi.com/services', data => {
            let servicesContainer = document.getElementById('services-container');
            servicesContainer.innerHTML = "";
            data.forEach(service => {
                let serviceItem = document.createElement('div');
                serviceItem.innerHTML = `
                    <img src="${service.service_icon}" alt="${service.service_name}">
                    <p>${service.service_name}</p>
                `;
                servicesContainer.appendChild(serviceItem);
            });
        });

        fetchData('https://take-home-test-api.nutech-integrasi.com/banner', data => {
            let promoContainer = document.getElementById('promo-container');
            promoContainer.innerHTML = "";
            data.forEach(banner => {
                let bannerItem = document.createElement('div');
                bannerItem.classList.add('promo-item');
                bannerItem.innerHTML = `<img src="${banner.banner_image}" alt="${banner.banner_name}">`;
                promoContainer.appendChild(bannerItem);
            });
        });
    </script>
</body>
</html>
