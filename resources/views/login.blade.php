@extends('layouts.app')
@section('page-name', 'Login POS')

@section('content')
<main class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">
                  <canvas id="koiBackground"></canvas>

<style>
    /* Canvas selalu ada di belakang */
    #koiBackground {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* biar di belakang card */
    }
</style>

                    <!-- Logo & Title -->
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <a href="/" class="logo d-flex align-items-center w-auto text-decoration-none">
                            <img src="{{ asset('assets/image/logoppkdjp.jpeg') }}" alt="Logo" class="me-2 rounded-circle shadow-sm" width="70" height="70">
                            <span class="h5 fw-bold text-primary">PPKD JakPus | POS</span>
                        </a>
                    </div>

                    <!-- Card -->
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h5 class="card-title fw-bold text-dark">Login to Your Account</h5>
                                <p class="text-muted small">Enter your email & password to continue</p>
                            </div>

                            <!-- Form -->
                            <form class="row g-3" method="post" action="/action-login">
                                @csrf
                                <!-- Email -->
                                <div class="col-12">
                                    <label for="yourEmail" class="form-label fw-semibold">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="yourEmail" placeholder="example@mail.com" required>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label fw-semibold">Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password"
                                            class="form-control" id="yourPassword" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <!-- Login Button -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100 py-2 fw-bold" type="submit" name="login">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </button>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-4 small text-muted">
                        <script>document.write(new Date().getFullYear())</script> 
                        <span class="fw-semibold">Vicki Maulana</span> &copy; All Rights Reserved
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@section('script')
<canvas id="koiBackground"></canvas>

<script>
(() => {
    const canvas = document.getElementById("koiBackground");
    const ctx = canvas.getContext("2d");

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // load gambar ikan
    const koiImg = new Image();
    koiImg.src = "{{ asset('assets/image/koi.png') }}"; // pastikan ada file koi.png

    class Fish {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = 60;
            this.speed = 1.5;
            this.target = null;
        }

        draw() {
            ctx.drawImage(koiImg, this.x - this.size/2, this.y - this.size/2, this.size, this.size);
        }

        update() {
            if (this.target) {
                let dx = this.target.x - this.x;
                let dy = this.target.y - this.y;
                let dist = Math.sqrt(dx*dx + dy*dy);
                if (dist > 3) {
                    this.x += (dx / dist) * this.speed;
                    this.y += (dy / dist) * this.speed;
                } else {
                    // ikan sampai ke pelet → hapus pelet
                    foods.splice(foods.indexOf(this.target), 1);
                    this.target = null;
                }
            }
            this.draw();
        }
    }

    class Food {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.size = 8;
        }
        draw() {
            ctx.beginPath();
            ctx.fillStyle = "brown";
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
            ctx.closePath();
        }
    }

    let fishes = [];
    let foods = [];

    // buat 5 ikan
    for (let i = 0; i < 5; i++) {
        fishes.push(new Fish());
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        foods.forEach(food => food.draw());
        fishes.forEach(fish => {
            // kalau ikan belum punya target → cari pelet
            if (!fish.target && foods.length > 0) {
                fish.target = foods[Math.floor(Math.random() * foods.length)];
            }
            fish.update();
        });

        requestAnimationFrame(animate);
    }
    animate();

    // klik canvas → kasih pelet
    canvas.addEventListener("click", (e) => {
        foods.push(new Food(e.clientX, e.clientY));
    });

    // resize canvas kalau window berubah
    window.addEventListener("resize", () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });
})();
</script>

@endsection

