// Big Think+ Prototype — Main JS

document.addEventListener('DOMContentLoaded', function () {

  // ── Nav scroll shadow ─────────────────────────────
  var nav = document.getElementById('main-nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      nav.classList.toggle('scrolled', window.scrollY > 10);
    });
  }

  // ── Mobile menu toggle ────────────────────────────
  var mobileBtn  = document.getElementById('mobile-menu-btn');
  var mobileMenu = document.getElementById('mobile-menu');
  if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener('click', function () {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // ── Close AI modal on backdrop click ─────────────
  var aiModal = document.getElementById('ai-modal');
  if (aiModal) {
    aiModal.addEventListener('click', function (e) {
      if (e.target === aiModal) aiModal.classList.add('hidden');
    });
  }

  // ── Escape key closes modal ───────────────────────
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && aiModal) aiModal.classList.add('hidden');
  });

  // ── Lazy load images ──────────────────────────────
  if ('IntersectionObserver' in window) {
    var lazyImgs = document.querySelectorAll('img[loading="lazy"]');
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var img = entry.target;
          if (img.dataset.src) img.src = img.dataset.src;
          observer.unobserve(img);
        }
      });
    }, { rootMargin: '200px' });
    lazyImgs.forEach(function (img) { observer.observe(img); });
  }

});
