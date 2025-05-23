<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Download Member Card - {{ $card->name }}</title>
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

        .download-button {
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

        .download-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <div class="card-container">
            <div class="member-card" id="card">
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

        <button onclick="downloadCard()" class="download-button">
            Download Card as PNG
        </button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadCard() {
            const element = document.getElementById('card');
            html2canvas(element, {
                scale: 2, // Tingkatkan kualitas gambar
                backgroundColor: null // Pertahankan background transparan
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'member_card_{{ $card->membership_number }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            }).catch(error => {
                alert('Error generating image: ' + error);
            });
        }
    </script>
</body>

</html>