<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - GeoToba</title>
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
        .step.done   { background: #27ae60; color: white; }
        .step.active { background: #c6a43b; color: white; }
        .step-label  { font-size: 0.7rem; color: #888; text-align: center; margin-top: 4px; }
        .form-control { border-radius: 12px; padding: 12px 16px; border: 1.5px solid #e0e0e0; font-size: 0.88rem; transition: all 0.2s; }
        .form-control:focus { border-color: #c6a43b; box-shadow: 0 0 0 3px rgba(198,164,59,0.12); }
        .btn-gold { background: #c6a43b; color: #003366; font-weight: 700; border: none; padding: 12px; border-radius: 12px; width: 100%; font-size: 0.9rem; letter-spacing: 0.5px; transition: all 0.3s; }
        .btn-gold:hover { background: #003366; color: white; transform: translateY(-2px); }
        .strength-bar { height: 4px; border-radius: 2px; background: #eee; margin-top: 6px; overflow: hidden; }
        .strength-fill { height: 100%; border-radius: 2px; transition: all 0.3s; width: 0; }
        .input-wrapper { position: relative; }
        .toggle-pw { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #aaa; font-size: 0.85rem; user-select: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h4>🔒 Password Baru</h4>
                        <p>Langkah terakhir — buat password yang kuat</p>
                    </div>
                    <div class="card-body">

                        {{-- Step indicator --}}
                        <div class="step-indicator">
                            <div>
                                <div class="step done">✓</div>
                                <div class="step-label">Email</div>
                            </div>
                            <div style="margin-top:10px; color:#27ae60; font-size:1.2rem;">›</div>
                            <div>
                                <div class="step done">✓</div>
                                <div class="step-label">OTP</div>
                            </div>
                            <div style="margin-top:10px; color:#c6a43b; font-size:1.2rem;">›</div>
                            <div>
                                <div class="step active">3</div>
                                <div class="step-label">Password Baru</div>
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size:0.83rem;">
                                ❌ {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.85rem;">Password Baru</label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" id="pwNew" class="form-control" placeholder="Minimal 6 karakter" required>
                                    <span class="toggle-pw" onclick="togglePw('pwNew', this)">👁️</span>
                                </div>
                                <div class="strength-bar mt-1">
                                    <div class="strength-fill" id="strengthFill"></div>
                                </div>
                                <div id="strengthText" style="font-size:0.75rem; color:#888; margin-top:4px;"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold" style="font-size:0.85rem;">Konfirmasi Password</label>
                                <div class="input-wrapper">
                                    <input type="password" name="password_confirmation" id="pwConfirm" class="form-control" placeholder="Ulangi password baru" required>
                                    <span class="toggle-pw" onclick="togglePw('pwConfirm', this)">👁️</span>
                                </div>
                                <div id="matchText" style="font-size:0.75rem; margin-top:4px;"></div>
                            </div>

                            <button type="submit" class="btn-gold">
                                ✅ Simpan Password Baru
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function togglePw(id, btn) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.textContent = input.type === 'password' ? '👁️' : '🙈';
    }

    // Password strength meter
    document.getElementById('pwNew').addEventListener('input', function () {
        const val = this.value;
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        let strength = 0;
        if (val.length >= 6)  strength++;
        if (val.length >= 10) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const levels = ['', '#e74c3c', '#e67e22', '#f1c40f', '#27ae60', '#003366'];
        const labels = ['', 'Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
        fill.style.width = (strength * 20) + '%';
        fill.style.background = levels[strength] || '';
        text.textContent = val.length ? labels[strength] : '';
        text.style.color = levels[strength] || '#888';
    });

    // Match check
    document.getElementById('pwConfirm').addEventListener('input', function () {
        const match = this.value === document.getElementById('pwNew').value;
        const el = document.getElementById('matchText');
        el.textContent = this.value ? (match ? '✅ Password cocok' : '❌ Password tidak cocok') : '';
        el.style.color  = match ? '#27ae60' : '#e74c3c';
    });
</script>
</body>
</html>