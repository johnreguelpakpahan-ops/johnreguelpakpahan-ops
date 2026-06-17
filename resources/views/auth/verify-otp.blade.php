<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - GeoToba</title>
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
        .otp-inputs { display: flex; gap: 10px; justify-content: center; margin: 24px 0; }
        .otp-inputs input {
            width: 52px; height: 62px;
            text-align: center; font-size: 1.6rem; font-weight: 700;
            border: 2px solid #ddd; border-radius: 12px;
            color: #003366; transition: all 0.2s;
            outline: none;
        }
        .otp-inputs input:focus { border-color: #c6a43b; box-shadow: 0 0 0 3px rgba(198,164,59,0.15); }
        .otp-inputs input.filled { border-color: #003366; background: #f0f4ff; }
        .btn-gold { background: #c6a43b; color: #003366; font-weight: 700; border: none; padding: 12px; border-radius: 12px; width: 100%; font-size: 0.9rem; letter-spacing: 0.5px; transition: all 0.3s; }
        .btn-gold:hover { background: #003366; color: white; transform: translateY(-2px); }
        .timer { text-align: center; font-size: 0.82rem; color: #888; margin-top: 14px; }
        .timer span { font-weight: 700; color: #c0392b; }
        .resend-link { color: #003366; font-weight: 600; cursor: pointer; text-decoration: underline; display: none; }
        .info-box { background: #f0f7ff; border-left: 4px solid #3498db; padding: 12px 16px; border-radius: 0 8px 8px 0; font-size: 0.82rem; color: #2980b9; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h4>🔐 Verifikasi OTP</h4>
                        <p>Masukkan kode 6 digit yang dikirim ke email Anda</p>
                    </div>
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success py-2 px-3" style="font-size:0.83rem;">
                                ✅ {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger py-2 px-3" style="font-size:0.83rem;">
                                ❌ {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="info-box">
                            📧 Kode OTP dikirim ke <strong>{{ session('otp_email') }}</strong>.<br>
                            Berlaku selama <strong>10 menit</strong>.
                        </div>

                        <form method="POST" action="{{ route('password.verify-otp') }}" id="otpForm">
                            @csrf

                            {{-- 6 kotak input OTP --}}
                            <div class="otp-inputs">
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d1" autofocus>
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d2">
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d3">
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d4">
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d5">
                                <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" inputmode="numeric" id="d6">
                            </div>

                            {{-- Hidden input gabungan OTP --}}
                            <input type="hidden" name="otp" id="otpHidden">

                            <button type="submit" class="btn-gold" id="submitBtn">
                                Verifikasi & Lanjutkan →
                            </button>
                        </form>

                        <div class="timer">
                            Kode kadaluarsa dalam: <span id="countdown">10:00</span>
                            <br>
                            <span class="resend-link" id="resendLink" onclick="window.location='{{ route('password.request') }}'">
                                Kirim ulang OTP
                            </span>
                        </div>

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

<script>
    // == OTP INPUT BEHAVIOUR ==
    const digits = document.querySelectorAll('.otp-digit');
    const hidden = document.getElementById('otpHidden');

    digits.forEach((input, i) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/, '');
            if (input.value) {
                input.classList.add('filled');
                if (i < digits.length - 1) digits[i + 1].focus();
            } else {
                input.classList.remove('filled');
            }
            updateHidden();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && i > 0) {
                digits[i - 1].focus();
                digits[i - 1].value = '';
                digits[i - 1].classList.remove('filled');
                updateHidden();
            }
        });

        // Support paste
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasted = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
            pasted.split('').forEach((ch, j) => {
                if (digits[j]) {
                    digits[j].value = ch;
                    digits[j].classList.add('filled');
                }
            });
            if (digits[pasted.length - 1]) digits[Math.min(pasted.length, 5)].focus();
            updateHidden();
        });
    });

    function updateHidden() {
        hidden.value = Array.from(digits).map(d => d.value).join('');
    }

    // == COUNTDOWN TIMER 10 menit ==
    let totalSeconds = 600;
    const countdownEl = document.getElementById('countdown');
    const resendLink  = document.getElementById('resendLink');

    const timer = setInterval(() => {
        totalSeconds--;
        const m = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
        const s = String(totalSeconds % 60).padStart(2, '0');
        countdownEl.textContent = m + ':' + s;

        if (totalSeconds <= 0) {
            clearInterval(timer);
            countdownEl.textContent = 'Kadaluarsa';
            countdownEl.style.color = '#c0392b';
            resendLink.style.display = 'inline';
            document.getElementById('submitBtn').disabled = true;
        }
    }, 1000);
</script>
</body>
</html>
