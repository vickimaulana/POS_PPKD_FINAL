@extends('layouts.app')
@section('page-name', 'Login POS')

@section('content')
<main class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

                    <!-- Background & Animasi Ikan -->
                    <style>
                        body {
                            margin: 0;
                            overflow: hidden;
                            height: 100vh;
                            background: linear-gradient(to bottom right, #5e2ea8, #c45d8a);
                            cursor: pointer;
                        }

                        /* Ikan */
                        .koi {
                            position: absolute;
                            width: 120px;
                            pointer-events: none;
                            transition: top 2s linear, left 2s linear;
                            image-rendering: auto;
                        }

                        /* Pelet */
                        .pelet {
                            position: absolute;
                            width: 15px;
                            height: 15px;
                            background: brown;
                            border-radius: 50%;
                            pointer-events: none;
                            animation: jatuh 2s linear forwards;
                        }

                        @keyframes jatuh {
                            from { transform: translateY(0); opacity: 1; }
                            to { transform: translateY(50px); opacity: 0.5; }
                        }
                    </style>

                    <!-- 5 ekor ikan (pakai GIF) -->
                    <img src="{{ asset('public/assets/images/koi1.gif') }}" class="koi" style="top:20%; left:10%;">
                    <img src="{{ asset('public/assets/images/koi2.gif') }}" class="koi" style="top:40%; left:20%;">
                    <img src="{{ asset('public/assets/images/koi1.gif') }}" class="koi" style="top:60%; left:30%;">
                    <img src="{{ asset('public/assets/images/koi2.gif') }}" class="koi" style="top:30%; left:50%;">
                    <img src="{{ asset('public/assets/images/koi1.gif') }}" class="koi" style="top:50%; left:70%;">

                    <!-- Logo & Title -->
                    <div class="d-flex justify-content-center align-items-center mb-4" style="z-index:10; position:relative;">
                        <a href="/" class="logo d-flex align-items-center w-auto text-decoration-none">
                            <img src="{{ asset('assets/image/logoppkdjp.jpeg') }}" alt="Logo" class="me-2 rounded-circle shadow-sm" width="70" height="70">
                            <span class="h5 fw-bold text-primary">PPKD JakPus | POS</span>
                        </a>
                    </div>

                    <!-- Card -->
                    <div class="card shadow-lg border-0 rounded-4" style="z-index:10; position:relative;">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h5 class="card-title fw-bold text-dark">Login to Your Account</h5>
                                <p class="text-muted small">Enter your email & password to continue</p>
                            </div>

                            <form class="row g-3" method="post" action="{{ route('login') }}">
                                @csrf
                                <!-- Email -->
                                <div class="col-12">
                                    <label for="yourEmail" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="yourEmail" placeholder="example@mail.com" required>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control" id="yourPassword" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <!-- Login Button -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100 py-2 fw-bold" type="submit" name="login">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-4 small text-muted" style="z-index:10; position:relative;">
                        <script>document.write(new Date().getFullYear())</script>
                        <span class="fw-semibold">Vicki Maulana</span> &copy; All Rights Reserved
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script')
<script>
    const kois = document.querySelectorAll(".koi");

    // Hitung jarak dua titik
    function distance(x1, y1, x2, y2) {
        return Math.sqrt((x2 - x1) ** 2 + (y2 - y1) ** 2);
    }

    // Klik = munculkan pelet + ikan terdekat ngejar
    document.addEventListener("click", (e) => {
        const x = e.clientX;
        const y = e.clientY;

        // buat pelet
        const pelet = document.createElement("div");
        pelet.className = "pelet";
        pelet.style.left = x + "px";
        pelet.style.top = y + "px";
        document.body.appendChild(pelet);

        // cari ikan terdekat
        let nearest = null;
        let minDist = Infinity;
        kois.forEach((koi) => {
            const koiX = koi.offsetLeft;
            const koiY = koi.offsetTop;
            const d = distance(koiX, koiY, x, y);
            if (d < minDist) {
                minDist = d;
                nearest = koi;
            }
        });

        // ikan terdekat ngejar pelet
        if (nearest) {
            nearest.style.left = (x - 60) + "px";
            nearest.style.top = (y - 60) + "px";
        }

        // hapus pelet setelah 2 detik
        setTimeout(() => {
            pelet.remove();
        }, 2000);
    });

    // animasi berenang bebas terus-menerus
    kois.forEach((koi) => {
        function swim() {
            const randX = Math.random() * (window.innerWidth - 150);
            const randY = Math.random() * (window.innerHeight - 150);
            koi.style.left = randX + "px";
            koi.style.top = randY + "px";
            setTimeout(swim, 300); // pindah tiap 3 detik
        }
        swim();
    });
</script>
@endsection
