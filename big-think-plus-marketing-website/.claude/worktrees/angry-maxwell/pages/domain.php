<?php
require_once __DIR__ . '/../data/data.php';

$slug   = $_GET['domain_slug'] ?? '';
$domain = bt_domain($slug);
if (!$domain) { http_response_code(404); echo '<h1>Domain not found</h1>'; exit; }

$classes    = bt_classes_by_domain($slug);
$all_domains = bt_domains();
$page_title  = $domain['title'];

include __DIR__ . '/../includes/header.php';
?>

<!-- ── DOMAIN HERO ───────────────────────────────────────────────────── -->
<section class="bg-navy text-white py-16 lg:py-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-white/40 mb-6 font-medium">
      <a href="/" class="hover:text-white/70 transition-colors">Home</a>
      <span>›</span>
      <a href="/#domains" class="hover:text-white/70 transition-colors">Leadership Domains</a>
      <span>›</span>
      <span class="text-white/70"><?= htmlspecialchars($domain['title']) ?></span>
    </nav>
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
      <div>
        <span class="inline-flex items-center gap-1.5 text-xs font-display font-600 uppercase tracking-widest text-bt-gold mb-4">
          <span class="w-6 h-px bg-bt-gold"></span> Leadership Domain
        </span>
        <h1 class="font-serif text-4xl lg:text-5xl font-bold mb-4"><?= htmlspecialchars($domain['title']) ?></h1>
        <p class="text-white/70 text-lg max-w-2xl leading-relaxed"><?= htmlspecialchars($domain['description']) ?></p>
      </div>
      <div class="flex-shrink-0 text-right">
        <p class="text-4xl font-serif font-bold text-white"><?= count($classes) ?></p>
        <p class="text-white/50 text-sm mt-1">Expert Classes</p>
      </div>
    </div>

    <!-- Domain switcher tabs -->
    <div class="flex flex-wrap gap-2 mt-10 pt-8 border-t border-white/10">
      <?php foreach ($all_domains as $od): ?>
      <a href="/domains/<?= $od['slug'] ?>"
         class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors <?= $od['slug'] === $slug ? 'bg-white text-navy' : 'bg-white/10 text-white/70 hover:bg-white/20' ?>">
        <?= htmlspecialchars($od['title']) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CLASS GRID ────────────────────────────────────────────────────── -->
<section class="bg-white py-14">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <!-- Toolbar -->
    <div class="flex items-center justify-between mb-8">
      <p class="text-sm text-gray-500">Showing <strong class="text-gray-900"><?= count($classes) ?></strong> Expert Classes in <strong class="text-gray-900"><?= htmlspecialchars($domain['title']) ?></strong></p>
      <div class="flex items-center gap-2">
        <span class="text-xs text-gray-400 font-medium">Sort:</span>
        <span class="text-xs font-semibold text-navy bg-navy/5 px-3 py-1.5 rounded-full">Newest First</span>
      </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
      <?php foreach ($classes as $class):
        $lesson1_url = "/expert-class/{$class['slug']}/lesson/1";
      ?>
      <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg hover:border-gray-300 transition-all duration-200 flex flex-col">

        <!-- Expert headshot (clickable) -->
        <a href="<?= $lesson1_url ?>" class="block relative overflow-hidden bg-gray-100 aspect-square">
          <img src="<?= htmlspecialchars($class['headshot']) ?>"
               alt="<?= htmlspecialchars($class['expert_name']) ?>"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
               loading="lazy">
          <!-- Play overlay on hover -->
          <div class="absolute inset-0 bg-navy/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-navy ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
          </div>
          <!-- Duration badge -->
          <span class="absolute bottom-2 right-2 text-xs font-semibold bg-black/60 text-white px-1.5 py-0.5 rounded"><?= htmlspecialchars($class['duration']) ?></span>
        </a>

        <!-- Card body -->
        <div class="p-4 flex flex-col flex-1">
          <p class="text-sm font-semibold text-gray-900 leading-tight"><?= htmlspecialchars($class['expert_name']) ?></p>
          <p class="text-xs text-gray-400 mt-0.5 line-clamp-1"><?= htmlspecialchars($class['expert_title']) ?></p>

          <a href="<?= $lesson1_url ?>" class="mt-2 text-sm font-semibold text-navy hover:text-navy-light leading-snug line-clamp-2 flex-1">
            <?= htmlspecialchars($class['title']) ?>
          </a>

          <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between gap-2">
            <span class="text-xs bg-navy/6 text-navy/80 px-2 py-0.5 rounded-full truncate font-medium"><?= htmlspecialchars($class['competency']) ?></span>
            <span class="text-xs text-gray-400 flex-shrink-0"><?= $class['lesson_count'] ?> lessons</span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ── DEMO CTA BANNER ───────────────────────────────────────────────── -->
<section class="bg-gray-50 border-t border-gray-200 py-14">
  <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
    <h3 class="font-serif text-3xl font-bold text-navy mb-3">Experience the Full Big Think+ Platform</h3>
    <p class="text-gray-500 mb-7 max-w-xl mx-auto">Request a demo to unlock all Expert Classes, discussion guides, and AI practice tools.</p>
    <a href="https://bigthink.com/plus/request-demo/" target="_blank"
       class="inline-flex items-center gap-2 bg-navy text-white font-semibold px-7 py-3.5 rounded-full hover:bg-navy-dark transition-colors">
      Request a Demo
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
