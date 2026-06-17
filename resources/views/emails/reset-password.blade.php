<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password GeoToba</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 550px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #003366 0%, #0a4a7a 100%);
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
            letter-spacing: 1px;
        }
        .header span {
            color: #c6a43b;
        }
        .header p {
            color: rgba(255,255,255,0.8);
            margin-top: 8px;
            font-size: 14px;
        }
        .content {
            padding: 35px;
        }
        .content h2 {
            color: #003366;
            margin-top: 0;
            font-size: 22px;
        }
        .content p {
            color: #555;
            line-height: 1.6;
            font-size: 15px;
        }
        .button {
            display: inline-block;
            background-color: #c6a43b;
            color: #003366 !important;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            margin: 25px 0;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #003366;
            color: white !important;
            transform: translateY(-2px);
        }
        .warning {
            background-color: #fff9e6;
            border-left: 4px solid #c6a43b;
            padding: 12px 18px;
            margin: 25px 0;
            font-size: 13px;
            color: #856404;
            border-radius: 8px;
        }
        .link-box {
            background: #f5f5f5;
            padding: 12px;
            border-radius: 8px;
            font-size: 12px;
            word-break: break-all;
            font-family: monospace;
            margin: 15px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #eee;
        }
        .footer a {
            color: #c6a43b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Geo<span>Toba</span></h1>
            <p>Geopark Danau Toba - Warisan Dunia UNESCO</p>
        </div>
        <div class="content">
            <h2>Halo, Admin!</h2>
            <p>Kami menerima permintaan untuk mereset password akun <strong>{{ $email }}</strong> Anda di sistem GeoToba.</p>
            <p>Klik tombol di bawah ini untuk membuat password baru:</p>
            
            <div style="text-align: center;">
                <a href="{{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}" class="button">
                    🔐 Reset Password Sekarang
                </a>
            </div>
            
            <div class="warning">
                <strong>⚠️ Perhatian:</strong> Link ini hanya berlaku selama <strong>60 menit</strong>. Jika Anda tidak meminta reset password, abaikan email ini.
            </div>
            
            <p>Atau salin link berikut ke browser Anda:</p>
            <div class="link-box">
                {{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}
            </div>
            
            <p>Jika Anda mengalami kendala, silakan hubungi tim support GeoToba.</p>
            
            <p>Salam,<br><strong>Tim GeoToba</strong></p>
        </div>
        <div class="footer">
            <p>&copy; 2026 GeoToba - Geopark Danau Toba. All rights reserved.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p><a href="{{ url('/') }}">www.geotoba.com</a></p>
        </div>
    </div>
</body>
</html>