<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .saldo-container {
            text-align: center; 
            background: url('<?= base_url('images/Background Saldo.png') ?>') no-repeat center center;
            background-size: cover;
            padding: 20px;
            color: white;
            border-radius: 10px;
            width: 100%; 
            max-width: 600px; 
            margin: 30px 0 70px auto; 
        }

        .saldo-container h2 {
            margin: 5px 0;
            font-size: 18px; 
        }
        .saldo-container button {
            font-size: 12px; 
            padding: 5px 10px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .transaction-item:last-child {
            border-bottom: none;
        }
        .transaction-info {
            display: flex;
            flex-direction: column;
        }
        .transaction-type {
            font-weight: bold;
            color: #333;
        }
        .transaction-date {
            font-size: 12px;
            color: #888;
        }
        .transaction-amount {
            font-weight: bold;
            color: #E44D26; 
        }
        .show-more {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            background: #E44D26;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
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


    <div class="saldo-container">
        <p>Saldo Anda</p>
        <h2>Rp ••••••••</h2>
        <button>Lihat Saldo</button>
    </div>
    <div class="container">
        <h4 class="text-center mb-3">Riwayat Transaksi</h4>

        <?php foreach ($transactions as $trx): ?>
            <div class="transaction-item">
                <div class="transaction-info">
                    <span class="transaction-type"><?= ucfirst(strtolower($trx['transaction_type'])); ?></span>
                    <span class="transaction-date"><?= date('d M Y, H:i', strtotime($trx['created_on'])); ?></span>
                </div>
                <div class="transaction-amount">
                    Rp <?= number_format($trx['total_amount'], 0, ',', '.'); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button class="show-more" id="showMoreBtn">Show More</button>
    </div>

    <script>
    let offset = 5; 

    document.getElementById('showMoreBtn').addEventListener('click', function() {
        fetch(`/history/more?offset=${offset}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    let container = document.querySelector('.container');
                    data.forEach(trx => {
                        let html = `<div class="transaction-item">
                            <div class="transaction-info">
                                <span class="transaction-type">${trx.transaction_type}</span>
                                <span class="transaction-date">${new Date(trx.created_on).toLocaleString()}</span>
                            </div>
                            <div class="transaction-amount">
                                Rp ${trx.total_amount.toLocaleString()}
                            </div>
                        </div>`;
                        container.insertAdjacentHTML('beforeend', html);
                    });
                    offset += 5;
                } else {
                    document.getElementById('showMoreBtn').style.display = 'none';
                }
            }).catch(error => console.log('Error:', error));
    });
</script>


</body>
</html>
