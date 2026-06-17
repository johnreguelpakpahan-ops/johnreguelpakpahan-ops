<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f9; padding: 40px 20px; }
        .wrapper { max-width: 560px; margin: 0 auto; }
        .card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #003366, #0a4a7a); padding: 28px 40px; text-align: center; }
        .header h1 { color: white; font-size: 20px; font-weight: 700; }
        .header p  { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 4px; }
        .body { padding: 32px 40px; }
        .badge { display: inline-block; background: #c6a43b; color: white; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
        .field { margin-bottom: 18px; }
        .field-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; color: #999; font-weight: 600; margin-bottom: 4px; }
        .field-value { font-size: 14px; color: #222; font-weight: 500; }
        .pesan-box { background: #f8f9fa; border-left: 4px solid #c6a43b; border-radius: 0 8px 8px 0; padding: 16px 18px; margin-top: 8px; font-size: 14px; color: #333; line-height: 1.7; white-space: pre-line; }
        .divider { border: none; border-top: 1px solid #eee; margin: 22px 0; }
        .reply-hint { background: #e8f4fd; border-radius: 8px; padding: 14px 16px; font-size: 13px; color: #2980b9; }
        .footer { background: #f9f9f9; padding: 18px 40px; text-align: center; border-top: 1px solid #eee; }
        .footer p { font-size: 12px; color: #aaa; }
        .footer strong { color: #c6a43b; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>📬 GeoToba</h1>
                <p>Pesan masuk dari form kontak website</p>
            </div>
            <div class="body">
                <span class="badge">✉️ Pesan Kontak Baru</span>

                <div class="field">
                    <div class="field-label">Nama Pengirim</div>
                    <div class="field-value">{{ $nama }}</div>
                </div>

                <div class="field">
                    <div class="field-label">Email</div>
                    <div class="field-value">{{ $pengirimEmail }}</div>
                </div>

                @if($telepon)
                <div class="field">
                    <div class="field-label">No. Telepon</div>
                    <div class="field-value">{{ $telepon }}</div>
                </div>
                @endif

                <div class="field">
                    <div class="field-label">Subjek</div>
                    <div class="field-value">{{ $subjek }}</div>
                </div>

                <hr class="divider">

                <div class="field">
                    <div class="field-label">Pesan</div>
                    <div class="pesan-box">{{ $pesan }}</div>
                </div>

                <div class="reply-hint">
                    💡 Klik <strong>Reply</strong> untuk langsung membalas email ke <strong>{{ $pengirimEmail }}</strong>
                </div>
            </div>
            <div class="footer">
                <p>Dikirim melalui form kontak <strong>GeoToba</strong> — {{ now()->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>
    </div>
</body>
</html>
