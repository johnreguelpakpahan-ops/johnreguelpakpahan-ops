<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - GeoToba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #003366 0%, #0a4a7a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card { border-radius: 20px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .card-header { background: linear-gradient(135deg, #1a1a1a, #2d2d2d); border-radius: 20px 20px 0 0 !important; padding: 28px; text-align: center; }
        .card-header h4 { color: white; margin: 0; font-size: 1.3rem; }
        .card-header p  { color: rgba(255,255,255,0.6); font-size: 0.82rem; margin: 6px 0 0; }
        .card-body { padding: 32px; }
        .step-indicator { display: flex; justify-content: center; gap: 8px; margin-bottom: 24px; }
        .step { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; }
        .step.active { background: #c6a43b; color: white; }
        .step.inactive { background: #e0e0e0; color: #999; }
        .step-label { font-size: 0.7rem; color: #888; text-align: center; margin-top: 4px; }
        .form-control { border-radius: 12px; padding: 12px 16px; border: 1.5px solid #e0e0e0; font-size: 0.88rem; transition: all 0.2s; }
        .form-control:focus { border-color: #c6a43b; box-shadow: 0 0 0 3px rgba(198,164,59,0.12); }
        .btn-gold { background: #c6a43b; color: #003366; font-weight: 700; border: none; padding: 12px; border-radius: 12px; width: 100%; font-size: 0.9rem; letter-spacing: 0.5px; transition: all 0.3s; }
        .btn-gold:hover { background: #003366; color: white; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h4>🔑 Lupa Password</h4>
                        <p>Kami kirimkan kode OTP ke email Anda</p>
                    </div>
                    <div class="card-body">

                        {{-- Step indicator --}}
                        <div class="step-indicator">
                            <div>
                                <div class="step active">1</div>
                                <div class="step-label">Email</div>
                            </div>
                            <div style="margin-top:10px; color:#ddd; font-size:1.2rem;">›</div>
                            <div>
                                <div class="step inactive">2</div>
                                <div class="step-label">OTP</div>
                            </div>
                            <div style="margin-top:10px; color:#ddd; font-size:1.2rem;">›</div>
                            <div>
                                <div class="step inactive">3</div>
                                <div class="step-label">Password Baru</div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success py-2 px-3 mb-3" style="font-size:0.83rem;">
                                ✅ {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size:0.83rem;">
                                ❌ {{ $errors->first() }}
                            </div>
                        @endif

                        <p class="text-muted mb-3" style="font-size:0.85rem;">
                            Masukkan email yang terdaftar. Kami akan mengirimkan <strong>kode OTP 6 digit</strong> untuk verifikasi identitas Anda.
                        </p>

                        <form method="POST" action="{{ route('password.send-otp') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.85rem;">Alamat Email</label>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                            <button type="submit" class="btn-gold">
                                Kirim Kode OTP →
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" style="color:#888; font-size:0.82rem; text-decoration:none;">
                                ← Kembali ke Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>