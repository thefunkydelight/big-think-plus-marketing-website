<?php
require_once __DIR__ . '/data/data.php';
$page_title = 'Big Think+ | Leadership Development Platform';
$domains = bt_domains();

// Get 3 featured classes per domain for showcase
$featured = [];
foreach ($domains as $dom) {
    $classes = bt_classes_by_domain($dom['slug']);
    $featured[$dom['slug']] = array_slice($classes, 0, 3);
}

// Hero expert names
$hero_experts = ['Kim Scott','Michael Watkins','Daniel Goleman','Ethan Mollick','Lynda Gratton','Ben Horowitz','Atul Gawande','Yuval Noah Harari'];
include __DIR__ . '/includes/header.php';
?>

<!-- ── HERO ─────────────────────────────────────────────────────────── -->
<section class="bg-navy text-white overflow-hidden relative">
  <!-- Background texture -->
  <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(circle at 1px 1px, white 1px, transparent 0);background-size:32px 32px;"></div>
  <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28 relative">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="inline-flex items-center gap-1.5 text-xs font-display font-600 uppercase tracking-widest text-bt-gold mb-6">
          <span class="w-6 h-px bg-bt-gold"></span> Leadership Development Platform
        </span>
        <h1 class="font-serif text-5xl lg:text-6xl xl:text-7xl font-bold leading-[1.05] mb-6">
          Unlock<br><em class="not-italic text-bt-gold">Leadership</em><br>Potential
        </h1>
        <p class="text-white/70 text-lg lg:text-xl leading-relaxed mb-8 max-w-lg">
          High-impact video microlearning from the world's biggest thinkers — delivered in the formats your teams will actually use.
        </p>
        <div class="flex flex-wrap gap-4">
          <a href="https://bigthink.com/plus/request-demo/" target="_blank"
             class="inline-flex items-center gap-2 bg-white text-navy font-semibold px-7 py-3.5 rounded-full hover:bg-gray-100 transition-colors text-sm">
            Request a Demo
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
          <a href="#domains" class="inline-flex items-center gap-2 border border-white/30 text-white font-semibold px-7 py-3.5 rounded-full hover:bg-white/10 transition-colors text-sm">
            Explore Domains
          </a>
        </div>
        <!-- Stats -->
        <div class="flex flex-wrap gap-8 mt-12 pt-8 border-t border-white/10">
          <div><p class="text-3xl font-serif font-bold text-white">1,500<span class="text-bt-gold">+</span></p><p class="text-xs text-white/50 mt-1 uppercase tracking-wide">Video Lessons</p></div>
          <div><p class="text-3xl font-serif font-bold text-white">150<span class="text-bt-gold">+</span></p><p class="text-xs text-white/50 mt-1 uppercase tracking-wide">Expert Classes</p></div>
          <div><p class="text-3xl font-serif font-bold text-white">5</p><p class="text-xs text-white/50 mt-1 uppercase tracking-wide">Leadership Domains</p></div>
        </div>
      </div>

      <!-- Expert headshot grid -->
      <div class="hidden lg:grid grid-cols-4 gap-3">
        <?php foreach ($hero_experts as $i => $expert):
          $nums = [45,52,77,31,58,60,43,81];
          $genders = ['women','men','men','men','women','men','men','men'];
          $headshot = "https://randomuser.me/api/portraits/{$genders[$i]}/{$nums[$i]}.jpg";
        ?>
        <div class="<?= $i % 2 === 1 ? 'mt-6' : '' ?> group cursor-pointer">
          <div class="aspect-square rounded-xl overflow-hidden ring-2 ring-white/10 group-hover:ring-bt-gold/60 transition-all">
            <img src="<?= $headshot ?>" alt="<?= htmlspecialchars($expert) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
          </div>
          <p class="text-center text-xs text-white/50 mt-2 font-medium"><?= htmlspecialchars($expert) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ── SOCIAL PROOF ──────────────────────────────────────────────────── -->
<section class="bg-white py-12 border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <p class="text-center text-xs font-display font-600 uppercase tracking-widest text-gray-400 mb-8">Trusted by the most innovative L&D teams</p>
    <div class="flex flex-wrap items-center justify-center gap-10 lg:gap-16">
      <?php
      $logos = ['Microsoft','Google','Amazon','Salesforce','McKinsey','Deloitte','JPMorgan','Stryker','Marriott'];
      foreach ($logos as $logo): ?>
      <span class="text-gray-300 font-display font-600 text-lg tracking-wide hover:text-gray-400 transition-colors"><?= $logo ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── LEADERSHIP DOMAINS (NEW) ─────────────────────────────────────── -->
<section id="domains" class="bg-gray-50 py-20 lg:py-28">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-1.5 text-xs font-display font-600 uppercase tracking-widest text-navy/60 mb-4">
        <span class="w-6 h-px bg-navy/30"></span> Expert Classes
      </span>
      <h2 class="font-serif text-4xl lg:text-5xl font-bold text-navy mb-4">Leadership Domains</h2>
      <p class="text-gray-500 text-lg max-w-2xl mx-auto">Explore 150+ Expert Classes organized across five leadership domains — each designed to develop the capabilities that matter most.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $domain_icons = [
        'character-and-integrity'          => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'customer-and-results-orientation' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
        'growth-and-change'                => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
        'people-and-culture'               => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
        'vision-and-strategy'              => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
      ];
      $domain_counts = [];
      foreach ($domains as $dom) {
        $domain_counts[$dom['slug']] = count(bt_classes_by_domain($dom['slug']));
      }
      foreach ($domains as $i => $dom):
        $count = $domain_counts[$dom['slug']];
        $sample = $featured[$dom['slug']];
      ?>
      <a href="/domains/<?= $dom['slug'] ?>" class="group bg-white rounded-2xl p-7 border border-gray-200 hover:border-navy/30 hover:shadow-lg transition-all duration-200 flex flex-col <?= $i === 0 ? 'lg:col-span-1 md:col-span-2 lg:md:col-span-1' : '' ?>">
        <div class="flex items-start justify-between mb-4">
          <div class="w-11 h-11 rounded-xl bg-navy/8 flex items-center justify-center">
            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <?= $domain_icons[$dom['slug']] ?? '' ?>
            </svg>
          </div>
          <span class="text-xs font-semibold text-navy/50 bg-navy/5 px-2.5 py-1 rounded-full"><?= $count ?> classes</span>
        </div>
        <h3 class="font-serif text-xl font-bold text-navy mb-2 group-hover:text-navy-light transition-colors"><?= htmlspecialchars($dom['title']) ?></h3>
        <p class="text-sm text-gray-500 leading-relaxed flex-1"><?= htmlspecialchars($dom['description']) ?></p>

        <!-- Sample expert faces -->
        <div class="flex items-center gap-3 mt-5 pt-5 border-t border-gray-100">
          <div class="flex -space-x-2">
            <?php foreach (array_slice($sample, 0, 3) as $sc): ?>
            <img src="<?= $sc['headshot'] ?>" alt="<?= htmlspecialchars($sc['expert_name']) ?>"
                 class="w-7 h-7 rounded-full ring-2 ring-white object-cover">
            <?php endforeach; ?>
          </div>
          <span class="text-xs text-gray-400">
            <?= implode(', ', array_map(fn($sc) => explode(' ', $sc['expert_name'])[0], array_slice($sample,0,2))) ?>
            <?php if ($count > 2): ?> +<?= $count - 2 ?> more<?php endif; ?>
          </span>
          <span class="ml-auto text-navy text-sm font-semibold group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── WHAT IS AN EXPERT CLASS ──────────────────────────────────────── -->
<section class="bg-white py-20 lg:py-28">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div>
        <span class="inline-flex items-center gap-1.5 text-xs font-display font-600 uppercase tracking-widest text-navy/60 mb-5">
          <span class="w-6 h-px bg-navy/30"></span> Learning Formats
        </span>
        <h2 class="font-serif text-4xl lg:text-5xl font-bold text-navy mb-6">The Expert Class Experience</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-8">Expert Classes are in-depth video series from the world's leading thinkers — structured curricula that take learners from awareness to application in 30–50 minutes.</p>
        <div class="space-y-5">
          <?php
          $features = [
            ['6–8 focused lessons','Each class is structured as a curriculum, with sequential lessons that build on one another.','M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
            ['Learner guides & transcripts','Every lesson includes a full transcript, practice prompts, and a downloadable learner guide.','M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['AI Practice Partner','Learners practice concepts with an AI partner trained on each expert\'s frameworks.','M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H4a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v10a2 2 0 01-2 2h-1'],
          ];
          foreach ($features as $f): ?>
          <div class="flex gap-4">
            <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-navy/8 flex items-center justify-center mt-0.5">
              <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?= $f[2] ?>"/>
              </svg>
            </div>
            <div>
              <p class="font-semibold text-gray-900 mb-1"><?= $f[0] ?></p>
              <p class="text-sm text-gray-500 leading-relaxed"><?= $f[1] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Mock lesson player card -->
      <div class="bg-gray-50 rounded-2xl overflow-hidden border border-gray-200 shadow-lg">
        <!-- Video area -->
        <div class="bg-navy aspect-video flex items-center justify-center relative overflow-hidden">
          <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="" class="absolute inset-0 w-full h-full object-cover opacity-30">
          <div class="relative z-10 w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-navy ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          </div>
          <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2">
            <div class="flex-1 bg-white/20 rounded-full h-1"><div class="bg-white rounded-full h-1 w-1/3"></div></div>
            <span class="text-white text-xs">1:42 / 5:00</span>
          </div>
        </div>
        <!-- Lesson meta -->
        <div class="p-5">
          <div class="flex items-start justify-between">
            <div>
              <span class="text-xs font-display font-600 uppercase tracking-widest text-navy/50">Lesson 1 of 7</span>
              <h4 class="font-semibold text-gray-900 mt-1">What Radical Respect Really Means</h4>
              <p class="text-sm text-gray-500 mt-0.5">Kim Scott · 5 min</p>
            </div>
            <span class="text-xs bg-green-50 text-green-700 font-semibold px-2 py-1 rounded-full">Free Preview</span>
          </div>
          <!-- Locked lessons -->
          <div class="mt-4 space-y-2">
            <?php
            $demo_lessons = [['Recognizing Bias Without Weaponizing It','6m'],['Addressing Prejudice in Real Time','5m'],['How Bullying Differs From Feedback','7m']];
            foreach ($demo_lessons as $dl): ?>
            <div class="flex items-center gap-3 py-2 px-3 bg-white rounded-lg border border-gray-100">
              <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              <span class="text-sm text-gray-400 flex-1"><?= $dl[0] ?></span>
              <span class="text-xs text-gray-300"><?= $dl[1] ?></span>
            </div>
            <?php endforeach; ?>
          </div>
          <a href="/expert-class/radical-respect-at-work/lesson/1"
             class="block mt-4 text-center bg-navy text-white text-sm font-semibold py-2.5 rounded-lg hover:bg-navy-dark transition-colors">
            Preview this Expert Class →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── PLATFORM FEATURES ─────────────────────────────────────────────── -->
<section class="bg-gray-50 py-20 lg:py-28">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-14">
      <h2 class="font-serif text-4xl font-bold text-navy mb-4">Everything Your L&D Team Needs</h2>
      <p class="text-gray-500 text-lg max-w-2xl mx-auto">Big Think+ is a full learning platform designed to meet your organization where it is and take it further.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      $platform_features = [
        ['Personalized Recommendations','AI-powered recommendations that match content to each learner\'s role, level, and goals.','M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
        ['Integrations','Seamless connections to your LMS, HRIS, and the tools your teams already use daily.','M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
        ['Analytics','Measure engagement, completion, and skill development at the individual and team level.','M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
        ['AI Practice Partner','Learners practice applying concepts with an AI partner trained on each expert\'s frameworks.','M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
        ['Transcription & Translation','Auto-captions and translations in 25+ languages — built for global organizations.','M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129'],
        ['Instructional Design','Expert curriculum designers available to build custom learning journeys for your teams.','M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['Curations','Handpicked content collections curated for specific roles, initiatives, and team goals.','M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
        ['Assessments','Knowledge checks and skills assessments to verify learning and surface gaps.','M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
      ];
      foreach ($platform_features as $feat): ?>
      <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md transition-shadow">
        <div class="w-10 h-10 rounded-lg bg-navy/8 flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?= $feat[2] ?>"/>
          </svg>
        </div>
        <h3 class="font-semibold text-gray-900 mb-2"><?= $feat[0] ?></h3>
        <p class="text-sm text-gray-500 leading-relaxed"><?= $feat[1] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── TESTIMONIALS ──────────────────────────────────────────────────── -->
<section class="bg-white py-20 lg:py-28">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-14">
      <h2 class="font-serif text-4xl font-bold text-navy mb-4">What L&D Leaders Say</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <?php
      $testimonials = [
        ['"Big Think+ gives us a way to introduce leadership concepts that feel fresh and credible. Our managers actually look forward to their development time — which is not something we could say before."','Sarah K.','Head of Learning & Development','Corning','women',22],
        ['"The Expert Class format is exactly what our senior leaders needed. Deep enough to create real shifts in thinking, short enough to fit into a packed schedule. Completion rates speak for themselves: 72%."','James M.','Chief People Officer','Stryker','men',42],
        ['"We\'ve tried a lot of platforms. Big Think+ is the first one where the content quality is high enough that leaders share it with each other voluntarily. That tells you everything."','Maria T.','VP of Talent Development','Marriott International','women',57],
      ];
      foreach ($testimonials as $t): ?>
      <div class="bg-gray-50 rounded-2xl p-7 border border-gray-200">
        <p class="text-gray-700 text-base leading-relaxed mb-6 font-serif italic"><?= $t[0] ?></p>
        <div class="flex items-center gap-3">
          <img src="https://randomuser.me/api/portraits/<?= $t[5] ?>s/<?= $t[5] === 'women' ? $t[5] : '' ?><?= $t[5] ?>/<?= rand(20,70) ?>.jpg"
               alt="<?= htmlspecialchars($t[1]) ?>" class="w-10 h-10 rounded-full object-cover">
          <div>
            <p class="font-semibold text-gray-900 text-sm"><?= $t[1] ?></p>
            <p class="text-xs text-gray-500"><?= $t[2] ?>, <?= $t[3] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FINAL CTA ─────────────────────────────────────────────────────── -->
<section class="bg-navy py-20 lg:py-24">
  <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
    <h2 class="font-serif text-4xl lg:text-5xl font-bold text-white mb-5">Experience the Full Big Think+ Platform</h2>
    <p class="text-white/70 text-lg mb-10 max-w-2xl mx-auto">Request a demo to unlock all Expert Classes, AI practice tools, and the full learning platform — built for the leaders your organization needs to develop.</p>
    <a href="https://bigthink.com/plus/request-demo/" target="_blank"
       class="inline-flex items-center gap-2 bg-white text-navy font-semibold px-8 py-4 rounded-full hover:bg-gray-100 transition-colors text-base">
      Request a Demo
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
