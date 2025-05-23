<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Member Card - {{ $card->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-container {
            perspective: 1000px;
            margin-bottom: 30px;
        }

        .member-card {
            width: 320px;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }

        .member-card:hover {
            transform: rotateY(5deg) rotateX(5deg);
        }

        .card-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.1;
            z-index: 1;
        }

        .card-pattern {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 2;
        }

        .card-pattern::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            width: 110px;
            height: 110px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .card-content {
            position: relative;
            z-index: 3;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-logo {
            font-size: 18px;
            font-weight: bold;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .card-type {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .member-info {
            margin-top: 15px;
        }

        .member-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .member-number {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
            font-family: 'Courier New', monospace;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: end;
        }

        .join-date {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.8);
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
        }

        .member-since {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 3px;
        }

        .print-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 400px;
        }

        .print-info h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .instructions {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }

        .instructions ol {
            padding-left: 18px;
        }

        .instructions li {
            margin-bottom: 8px;
        }

        .print-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .print-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .print-info,
            .no-print {
                display: none !important;
            }

            .card-container {
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .member-card {
                box-shadow: none;
                transform: none;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 10px;
            }

            .member-card {
                width: 280px;
                height: 175px;
            }

            .card-content {
                padding: 15px;
            }

            .member-name {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <div class="card-container">
            <div class="member-card">
                <div class="card-background"></div>
                <div class="card-pattern"></div>

                <div class="card-content">
                    <div class="card-header">
                        <div>
                            <div class="company-logo">MEMBERSHIP</div>
                            <div class="card-type">Premium Member</div>
                        </div>
                        <div class="status-badge">
                            @if(!$card->expiry_date || \Carbon\Carbon::parse($card->expiry_date)->isFuture())
                            ACTIVE
                            @else
                            EXPIRED
                            @endif
                        </div>
                    </div>

                    <div class="member-info">
                        <div class="member-name">{{ strtoupper($card->name) }}</div>
                        <div class="member-number">No Hp: {{ $card->membership_number }}</div>
                        <div class="member-since">
                            Member since {{ \Carbon\Carbon::parse($card->joining_date)->format('M Y') }}
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="join-date">
                            <div>Valid From</div>
                            <div>{{ \Carbon\Carbon::parse($card->joining_date)->format('m/d/Y') }}</div>
                        </div>
                        @if($card->expiry_date)
                        <div class="join-date">
                            <div>Valid Until</div>
                            <div>{{ \Carbon\Carbon::parse($card->expiry_date)->format('m/d/Y') }}</div>
                        </div>
                        @else
                        <div class="join-date">
                            <div>Membership</div>
                            <div>LIFETIME</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="print-info no-print">
            <h3><i class="fas fa-info-circle"></i> Cara Penggunaan Kartu Member</h3>
            <div class="instructions">
                <ol>
                    <li><strong>Cetak kartu</strong> pada kertas tebal atau karton untuk hasil terbaik</li>
                    <li><strong>Potong</strong> sesuai ukuran kartu (dapat dilaminasi untuk ketahanan)</li>
                    <li><strong>Tunjukkan kartu</strong> saat menggunakan layanan atau fasilitas member</li>
                    <li><strong>Simpan dengan baik</strong> - kartu ini bersifat personal dan tidak dapat dipindahtangankan</li>
                    <li><strong>Hubungi customer service</strong> jika kartu hilang atau rusak</li>
                </ol>

                <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                    <strong>Info Kartu:</strong><br>
                    Nama: {{ $card->name }}<br>
                    No Hp: {{ $card->membership_number }}<br>
                    Tanggal Bergabung: {{ \Carbon\Carbon::parse($card->joining_date)->format('d F Y') }}<br>
                    @if($card->expiry_date)
                    Berlaku Hingga: {{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}
                    @else
                    Keanggotaan: Seumur Hidup
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>