<!-- ── FOOTER ─────────────────────────────────────────────────────── -->
<footer class="bg-navy text-white mt-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10">

      <!-- Brand col -->
      <div class="col-span-2 lg:col-span-1">
        <span class="font-display font-700 text-2xl tracking-tight">Big Think+</span>
        <p class="mt-3 text-sm text-white/60 leading-relaxed">High-impact video microlearning from the world's biggest thinkers.</p>
        <div class="flex items-center gap-3 mt-5">
          <a href="#" class="text-white/50 hover:text-white transition-colors" aria-label="LinkedIn">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="#" class="text-white/50 hover:text-white transition-colors" aria-label="YouTube">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
          </a>
        </div>
      </div>

      <!-- Content -->
      <div>
        <h4 class="text-xs font-display font-600 uppercase tracking-widest text-white/50 mb-4">Content</h4>
        <ul class="space-y-2.5 text-sm text-white/70">
          <li><a href="#" class="hover:text-white transition-colors">Our Approach</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Experts</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Library</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Expert Classes</a></li>
        </ul>
      </div>

      <!-- Platform -->
      <div>
        <h4 class="text-xs font-display font-600 uppercase tracking-widest text-white/50 mb-4">Platform</h4>
        <ul class="space-y-2.5 text-sm text-white/70">
          <li><a href="#" class="hover:text-white transition-colors">Overview</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Recommendations</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Analytics</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
        </ul>
      </div>

      <!-- Domains -->
      <div>
        <h4 class="text-xs font-display font-600 uppercase tracking-widest text-white/50 mb-4">Domains</h4>
        <ul class="space-y-2.5 text-sm text-white/70">
          <?php require_once __DIR__ . '/../data/data.php'; foreach (bt_domains() as $fd): ?>
          <li><a href="/domains/<?= $fd['slug'] ?>" class="hover:text-white transition-colors"><?= htmlspecialchars($fd['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Company -->
      <div>
        <h4 class="text-xs font-display font-600 uppercase tracking-widest text-white/50 mb-4">Company</h4>
        <ul class="space-y-2.5 text-sm text-white/70">
          <li><a href="#" class="hover:text-white transition-colors">About</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Customer Stories</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Events</a></li>
          <li><a href="https://bigthink.com/plus/request-demo/" target="_blank" class="hover:text-white transition-colors font-semibold">Request a Demo</a></li>
        </ul>
      </div>

    </div>

    <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
      <p class="text-xs text-white/40">&copy; <?= date('Y') ?> Big Think+. All rights reserved.</p>
      <div class="flex items-center gap-5 text-xs text-white/40">
        <a href="#" class="hover:text-white/70 transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-white/70 transition-colors">Terms of Use</a>
        <a href="#" class="hover:text-white/70 transition-colors">Cookie Settings</a>
      </div>
    </div>
  </div>
</footer>

<script src="/assets/js/main.js"></script>
</body>
</html>
