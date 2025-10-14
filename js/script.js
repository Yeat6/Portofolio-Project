// ambil semua elemen dengan class "reveal"
const reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {
  reveals.forEach((el) => {
    const windowHeight = window.innerHeight;
    const elementTop = el.getBoundingClientRect().top;
    const revealPoint = 100; // jarak sebelum muncul

    if (elementTop < windowHeight - revealPoint) {
      el.classList.add("active");
    } else {
      el.classList.remove("active"); // kalau mau sekali aja, hapus baris ini
    }
  });
}

window.addEventListener("scroll", revealOnScroll);
