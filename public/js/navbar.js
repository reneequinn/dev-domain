const menuBtn = document.getElementById('menuBtn');
function toggleMenu() {
  const nav = document.getElementById('nav');
  nav.classList.toggle('hidden');
}
menuBtn.addEventListener('click', toggleMenu);
