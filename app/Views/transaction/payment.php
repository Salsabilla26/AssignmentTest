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
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .navbar img {
            width: 30px;
            height: auto;
        }
        .menu {
            display: flex;
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
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 80px 20px 20px; /* Adjust padding for navbar */
            width: 100%;
            max-width: 600px;
        }
        .profile-container img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        .saldo-form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 600px;
        }
        .saldo-container, .payment-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .saldo-container {
            background: red;
            color: white;
        }
        .btn-bayar {
            background: red;
            color: white;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
            <img src="<?= base_url('images/Profile Photo.png') ?>" alt="Avatar">
            <p>Selamat datang,</p>
            <h2 id="user-name">Loading...</h2>
        </div>
    </div>

    <div class="saldo-form-container">
        <div class="saldo-container">
            <p>Saldo Anda</p>
            <h2 id="saldo-amount">Rp ••••••••</h2>
            <button onclick="toggleSaldo()">Lihat Saldo</button>
        </div>
        
        <div class="payment-container">
            <h5>Pembayaran</h5>
            <p>Nominal: Rp<?= esc($amount); ?></p>
            <p><img src="<?= base_url('images/Listrik.png') ?>" width="20"> <b>Listrik Prabayar</b></p>
            <input type="text" class="form-control" value="10.000" readonly>
            <button class="btn-bayar mt-3">Bayar</button>
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
    </script>
</body>
</html>