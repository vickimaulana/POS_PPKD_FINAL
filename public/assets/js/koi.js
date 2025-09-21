const canvas = document.getElementById("koi-bg");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Koi {
  constructor(x, y) {
    this.x = x;
    this.y = y;
    this.size = 30;
    this.color = "orange";
    this.speedX = (Math.random() - 0.5) * 2;
    this.speedY = (Math.random() - 0.5) * 2;
  }
  update() {
    this.x += this.speedX;
    this.y += this.speedY;

    if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
    if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
  }
  draw() {
    ctx.beginPath();
    ctx.ellipse(this.x, this.y, this.size, this.size / 2, 0, 0, Math.PI * 2);
    ctx.fillStyle = this.color;
    ctx.fill();
    ctx.closePath();
  }
}

let kois = [];
for (let i = 0; i < 5; i++) {
  kois.push(new Koi(Math.random() * canvas.width, Math.random() * canvas.height));
}

let foods = [];
canvas.addEventListener("click", (e) => {
  foods.push({ x: e.clientX, y: e.clientY });
});

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  foods.forEach((food, index) => {
    ctx.fillStyle = "yellow";
    ctx.beginPath();
    ctx.arc(food.x, food.y, 5, 0, Math.PI * 2);
    ctx.fill();

    kois.forEach((koi) => {
      let dx = koi.x - food.x;
      let dy = koi.y - food.y;
      let distance = Math.sqrt(dx * dx + dy * dy);
      if (distance < 20) {
        foods.splice(index, 1);
      }
    });
  });

  kois.forEach((koi) => {
    koi.update();
    koi.draw();
  });

  requestAnimationFrame(animate);
}
animate();
