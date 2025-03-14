<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up - HIS PPOB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
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
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
        }
        .form-control {
            flex: 2;
            padding: 10px;
        }
        .nominal {
            flex: 1;
            padding: 10px;
            margin: 5px;
            background-color: #f5f5f5;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .nominal:hover {
            background-color: #ddd;
        }
        .topup-btn {
            flex: 2;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .topup-btn:disabled {
            background-color: #d3d3d3;
            cursor: not-allowed;
        }
        .saldo-container {
            background: red;
            color: white;
            padding: 20px;
            border-radius: 10px;
            min-width: 450px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
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

<div class="container">
    <h3>Selamat datang, <b>Kristanto Wibowo</b></h3>

    <div class="saldo-container">
            <p>Saldo Anda</p>
            <h2 id="saldo-amount">Rp ••••••••</h2>
            <button onclick="toggleSaldo()">Lihat Saldo</button>
        </div>

    <!-- Row pertama: Input dan tombol nominal -->
    <div class="row">
        <input type="number" id="nominalInput" class="form-control" placeholder="Masukkan nominal Top Up" min="10000" max="1000000" oninput="validateInput()">
        <button class="nominal" onclick="setNominal(10000)">Rp10.000</button>
        <button class="nominal" onclick="setNominal(20000)">Rp20.000</button>
        <button class="nominal" onclick="setNominal(50000)">Rp50.000</button>
    </div>

    <!-- Row kedua: Tombol Top Up dan tombol nominal -->
    <div class="row">
        <button id="topupBtn" class="topup-btn" disabled onclick="processTopUp()">Top Up</button>
        <button class="nominal" onclick="setNominal(100000)">Rp100.000</button>
        <button class="nominal" onclick="setNominal(250000)">Rp250.000</button>
        <button class="nominal" onclick="setNominal(500000)">Rp500.000</button>
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


    function validateInput() {
        const input = document.getElementById("nominalInput").value;
        const topupBtn = document.getElementById("topupBtn");

        if (input >= 10000 && input <= 1000000) {
            topupBtn.disabled = false;
        } else {
            topupBtn.disabled = true;
        }
    }

    function processTopUp() {
        const nominal = document.getElementById("nominalInput").value;

        if (nominal < 10000 || nominal > 1000000) {
            alert("Nominal tidak valid. Minimal Rp10.000 dan maksimal Rp1.000.000.");
            return;
        }

       
        alert(`Top Up sebesar Rp${nominal} sedang diproses...`);

        
        setTimeout(() => {
            window.location.href = "/transaction/payment/" + nominal;

        }, 2000); 
    }
</script>

</body>
</html>
