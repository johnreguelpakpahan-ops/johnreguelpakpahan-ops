<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f9; padding: 40px 20px; }
        .wrapper { max-width: 520px; margin: 0 auto; }
        .card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #003366, #0a4a7a); padding: 32px 40px; text-align: center; }
        .header h1 { color: white; font-size: 22px; font-weight: 700; letter-spacing: 1px; }
        .header p  { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 6px; }
        .body { padding: 36px 40px; }
        .body p { color: #444; font-size: 14px; line-height: 1.7; margin-bottom: 20px; }
        .otp-box {
            background: #f8f4e8;
            border: 2px dashed #c6a43b;
            border-radius: 12px;
            text-align: center;
            padding: 24px 16px;
            margin: 24px 0;
        }
        .otp-label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; }
        .otp-code  { font-size: 42px; font-weight: 800; letter-spacing: 12px; color: #003366; }
        .otp-expire { font-size: 12px; color: #c0392b; margin-top: 10px; font-weight: 600; }
        .warning { background: #fff8f0; border-left: 4px solid #f39c12; padding: 14px 16px; border-radius: 8px; font-size: 13px; color: #555; margin-top: 8px; }
        .footer { background: #f9f9f9; padding: 20px 40px; text-align: center; border-top: 1px solid #eee; }
        .footer p { font-size: 12px; color: #aaa; }
        .footer strong { color: #c6a43b; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>🔐 GeoToba</h1>
                <p>Reset Password - Kode Verifikasi OTP</p>
            </div>
            <div class="body">
                <p>Halo,</p>
                <p>Kami menerima permintaan reset password untuk akun dengan email <strong>{{ $email }}</strong>. Gunakan kode OTP berikut untuk melanjutkan proses reset password:</p>

                <div class="otp-box">
                    <div class="otp-label">Kode OTP Anda</div>
                    <div class="otp-code">{{ $otp }}</div>
                    <div class="otp-expire">⏰ Kode berlaku selama 10 menit</div>
                </div>

                <p>Masukkan kode ini pada halaman verifikasi OTP. Jangan bagikan kode ini kepada siapapun.</p>

                <div class="warning">
                    ⚠️ Jika Anda tidak merasa meminta reset password, abaikan email ini. Akun Anda tetap aman.
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} <strong>GeoToba</strong> — Geopark Danau Toba. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
