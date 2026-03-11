<?php
require_once __DIR__ . '/../data/data.php';

$class_slug    = $_GET['class_slug']    ?? '';
$lesson_number = (int)($_GET['lesson_number'] ?? 1);

$class  = bt_expert_class($class_slug);
if (!$class) { http_response_code(404); echo '<h1>Class not found</h1>'; exit; }

$lesson = bt_lesson($class_slug, $lesson_number);
if (!$lesson) { http_response_code(404); echo '<h1>Lesson not found</h1>'; exit; }

$domain   = bt_domain($class['domain']);
$is_locked = $lesson_number > 1;
$is_showcase = !empty($class['video_id']);

$page_title = $lesson['title'] . ' — ' . $class['title'];

// Truncate helpers
function first_n_words($text, $n = 20) {
    $words = explode(' ', strip_tags($text));
    if (count($words) <= $n) return $text;
    return implode(' ', array_slice($words, 0, $n)) . '…';
}

// For non-showcase classes, generate sample content
$summary   = $class['summary_l1']    ?: "In this lesson, {$class['expert_name']} explores the core concepts of {$class['title']}, offering a framework for understanding the key principles that define this area of leadership. Drawing on years of research and real-world experience, this lesson sets the foundation for everything that follows in the class.";
$transcript = $class['transcript_l1'] ?: '"Leadership is not a title — it\'s a practice. And like any practice, it can be learned, refined, and deepened over time. In this opening lesson, I want to give you a framework that you can carry through everything we cover together. Not a list of tips, but a way of thinking — a lens that will help you see the challenges ahead with greater clarity and respond to them with greater skill. Let\'s begin."';
$prompts   = !empty($class['prompts_l1']) ? $class['prompts_l1'] : [
    "Reflect on how the concepts introduced in this lesson apply to your current leadership context. What would change if you fully embodied this approach?",
    "Think of a leader you admire who exemplifies the principles in this lesson. What specific behaviors do they demonstrate?",
    "What is one action you could take in the next 48 hours to begin applying what you've learned?",
];

// Locked content: truncate
$locked_summary    = first_n_words($summary, 20);
$locked_transcript = first_n_words($transcript, 20);

include __DIR__ . '/../includes/lesson-header.php';
?>

<div class="min-h-screen bg-white">
  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 py-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6 font-medium">
      <a href="/" class="hover:text-navy transition-colors">Home</a>
      <span>›</span>
      <?php if ($domain): ?>
      <a href="/domains/<?= $domain['slug'] ?>" class="hover:text-navy transition-colors"><?= htmlspecialchars($domain['title']) ?></a>
      <span>›</span>
      <?php endif; ?>
      <span class="text-gray-600 line-clamp-1"><?= htmlspecialchars($class['title']) ?></span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr_300px] gap-6">

      <!-- ═══════════════════════════════════════════════════════════════
           LEFT SIDEBAR — Curriculum
      ════════════════════════════════════════════════════════════════ -->
      <aside class="hidden lg:block">
        <div class="sticky top-24">
          <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
            <!-- Class header in sidebar -->
            <div class="p-4 border-b border-gray-200 bg-white">
              <p class="text-xs font-display font-600 uppercase tracking-widest text-gray-400 mb-1">Expert Class</p>
              <h3 class="font-semibold text-gray-900 text-sm leading-snug"><?= htmlspecialchars($class['title']) ?></h3>
              <p class="text-xs text-gray-500 mt-1"><?= $class['lesson_count'] ?> lessons · <?= htmlspecialchars($class['duration']) ?> total</p>
            </div>

            <!-- Lesson list -->
            <div class="divide-y divide-gray-100">
              <?php foreach ($class['lessons'] as $l):
                $is_active  = $l['number'] === $lesson_number;
                $lesson_locked = $l['number'] > 1;
              ?>
              <?php if ($lesson_locked): ?>
              <a href="/expert-class/<?= $class_slug ?>/lesson/<?= $l['number'] ?>"
                 class="flex items-start gap-3 px-4 py-3.5 hover:bg-white transition-colors cursor-pointer <?= $is_active ? 'bg-navy/5 border-l-2 border-navy' : '' ?>">
              <?php else: ?>
              <a href="/expert-class/<?= $class_slug ?>/lesson/1"
                 class="flex items-start gap-3 px-4 py-3.5 hover:bg-white transition-colors <?= $is_active ? 'bg-navy/5 border-l-2 border-navy' : '' ?>">
              <?php endif; ?>
                <div class="flex-shrink-0 mt-0.5">
                  <?php if ($lesson_locked): ?>
                  <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center">
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                  </div>
                  <?php else: ?>
                  <div class="w-6 h-6 rounded-full <?= $is_active ? 'bg-navy' : 'bg-navy/10' ?> flex items-center justify-center">
                    <?php if ($is_active): ?>
                    <svg class="w-3 h-3 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <?php else: ?>
                    <span class="text-navy text-xs font-bold"><?= $l['number'] ?></span>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-xs font-medium leading-snug <?= $is_active ? 'text-navy' : ($lesson_locked ? 'text-gray-400' : 'text-gray-700') ?> line-clamp-2">
                    <?= htmlspecialchars($l['title']) ?>
                  </p>
                  <p class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars($l['duration']) ?></p>
                </div>
              </a>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Demo CTA in sidebar -->
          <div class="mt-4 bg-navy text-white rounded-xl p-5">
            <p class="text-xs font-display font-600 uppercase tracking-widest text-white/50 mb-2">Unlock All Classes</p>
            <p class="text-sm font-semibold mb-1">Experience the Full Platform</p>
            <p class="text-xs text-white/60 mb-4 leading-relaxed">Access all Expert Classes, AI practice tools, and discussion guides.</p>
            <a href="https://bigthink.com/plus/request-demo/" target="_blank"
               class="block text-center bg-white text-navy text-xs font-semibold py-2.5 rounded-lg hover:bg-gray-100 transition-colors">
              Request a Demo
            </a>
          </div>
        </div>
      </aside>

      <!-- ═══════════════════════════════════════════════════════════════
           MAIN CONTENT
      ════════════════════════════════════════════════════════════════ -->
      <main class="min-w-0">

        <!-- ── VIDEO PLAYER ───────────────────────────────────────── -->
        <?php if ($is_locked): ?>
        <!-- Locked video placeholder -->
        <div class="relative rounded-xl overflow-hidden bg-gray-900" style="aspect-ratio:16/9;">
          <img src="<?= htmlspecialchars($class['headshot']) ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-20 blur-sm">
          <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
            <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mb-4 border border-white/20">
              <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <h3 class="text-white font-semibold text-lg mb-2">Lesson <?= $lesson_number ?> is locked</h3>
            <p class="text-white/60 text-sm mb-6 max-w-sm">This lesson is part of the full Big Think+ learning platform. Request a demo to unlock the complete Expert Class.</p>
            <a href="https://bigthink.com/plus/request-demo/" target="_blank"
               class="inline-flex items-center gap-2 bg-white text-navy font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition-colors text-sm">
              Unlock the Full Lesson
            </a>
          </div>
        </div>

        <?php elseif ($is_showcase && !empty($class['video_id'])): ?>
        <!-- JW Player embed (showcase classes) -->
        <div id="video-wrapper" class="relative rounded-xl overflow-hidden bg-black" style="aspect-ratio:16/9;">
          <div id="video-poster" class="absolute inset-0 cursor-pointer group">
            <img id="poster-img"
                 src="https://cdn.jwplayer.com/v2/media/<?= htmlspecialchars($class['video_id']) ?>/poster.jpg"
                 alt="<?= htmlspecialchars($class['title']) ?>"
                 class="w-full h-full object-cover"
                 onerror="this.src='<?= htmlspecialchars($class['headshot']) ?>'">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors"></div>
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="w-20 h-20 bg-white/90 group-hover:bg-white rounded-full flex items-center justify-center shadow-xl transition-all group-hover:scale-105">
                <svg class="w-9 h-9 text-navy ml-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
              </div>
            </div>
            <!-- Caption bar -->
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent px-5 py-4">
              <p class="text-white text-sm font-semibold"><?= htmlspecialchars($lesson['title']) ?></p>
              <p class="text-white/60 text-xs mt-0.5"><?= htmlspecialchars($class['expert_name']) ?> · <?= htmlspecialchars($lesson['duration']) ?></p>
            </div>
          </div>
          <!-- Player loads here on click -->
          <div id="video-player-container" class="hidden w-full h-full"></div>
        </div>
        <script>
          document.getElementById('video-poster').addEventListener('click', function() {
            const wrapper = document.getElementById('video-wrapper');
            const poster  = document.getElementById('video-poster');
            const player  = document.getElementById('video-player-container');
            poster.classList.add('hidden');
            player.classList.remove('hidden');
            player.innerHTML = '<iframe src="https://content.jwplatform.com/players/<?= $class['video_id'] ?>.html" width="100%" height="100%" allowfullscreen frameborder="0" style="position:absolute;inset:0;width:100%;height:100%;"></iframe>';
          });
        </script>

        <?php else: ?>
        <!-- Generic playable placeholder for non-showcase classes -->
        <div class="relative rounded-xl overflow-hidden bg-navy" style="aspect-ratio:16/9;">
          <img src="<?= htmlspecialchars($class['headshot']) ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-25">
          <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/50 to-transparent"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-20 h-20 bg-white/90 rounded-full flex items-center justify-center shadow-xl">
              <svg class="w-9 h-9 text-navy ml-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 px-5 py-4">
            <p class="text-white text-sm font-semibold"><?= htmlspecialchars($lesson['title']) ?></p>
            <p class="text-white/60 text-xs mt-0.5"><?= htmlspecialchars($class['expert_name']) ?> · <?= htmlspecialchars($lesson['duration']) ?></p>
          </div>
        </div>
        <?php endif; ?>

        <!-- ── LESSON METADATA ────────────────────────────────────── -->
        <div class="mt-6 pb-6 border-b border-gray-100">
          <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="flex items-center gap-4">
              <img src="<?= htmlspecialchars($class['headshot']) ?>" alt="<?= htmlspecialchars($class['expert_name']) ?>"
                   class="w-12 h-12 rounded-full object-cover flex-shrink-0">
              <div>
                <h1 class="text-xl font-bold text-gray-900 leading-snug"><?= htmlspecialchars($lesson['title']) ?></h1>
                <p class="text-sm text-gray-500 mt-1">
                  <span class="font-semibold text-gray-700"><?= htmlspecialchars($class['expert_name']) ?></span>
                  · <?= htmlspecialchars($class['expert_title']) ?>
                </p>
              </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
              <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full font-medium">
                Lesson <?= $lesson_number ?> of <?= $class['lesson_count'] ?>
              </span>
              <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full font-medium">
                <?= htmlspecialchars($lesson['duration']) ?>
              </span>
              <?php if (!$is_locked): ?>
              <span class="text-xs text-green-700 bg-green-50 px-3 py-1.5 rounded-full font-semibold border border-green-200">
                Free Preview
              </span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- ── LESSON SUMMARY ──────────────────────────────────────── -->
        <div class="py-6 border-b border-gray-100">
          <h2 class="text-sm font-display font-600 uppercase tracking-widest text-gray-400 mb-4">Lesson Summary</h2>
          <?php if ($is_locked): ?>
          <div class="relative">
            <p class="text-gray-600 leading-relaxed"><?= htmlspecialchars($locked_summary) ?></p>
            <!-- Fade + gate overlay -->
            <div class="mt-4 p-5 bg-gray-50 rounded-xl border border-gray-200">
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <div>
                  <p class="text-sm font-semibold text-gray-900 mb-1">Unlock the Full Lesson</p>
                  <p class="text-xs text-gray-500 mb-3">This content is part of the Big Think+ learning platform. Request a demo to access the full Expert Class, discussion guides, and AI practice.</p>
                  <a href="https://bigthink.com/plus/request-demo/" target="_blank"
                     class="inline-flex items-center gap-1.5 bg-navy text-white text-xs font-semibold px-4 py-2 rounded-full hover:bg-navy-dark transition-colors">
                    Request a Demo
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php else: ?>
          <p class="text-gray-600 leading-relaxed text-base"><?= htmlspecialchars($summary) ?></p>
          <?php endif; ?>
        </div>

        <!-- ── TRANSCRIPT ──────────────────────────────────────────── -->
        <div class="py-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-display font-600 uppercase tracking-widest text-gray-400">Transcript</h2>
            <?php if (!$is_locked): ?>
            <button id="transcript-toggle" class="text-xs font-semibold text-navy hover:underline">Show full transcript</button>
            <?php endif; ?>
          </div>

          <?php if ($is_locked): ?>
          <div>
            <p class="text-gray-500 italic leading-relaxed text-sm"><?= htmlspecialchars($locked_transcript) ?></p>
            <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-center gap-3">
              <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              <p class="text-xs text-gray-500 flex-1">Full transcript available with a Big Think+ subscription.</p>
              <a href="https://bigthink.com/plus/request-demo/" target="_blank" class="text-xs font-semibold text-navy hover:underline flex-shrink-0">Request Demo →</a>
            </div>
          </div>
          <?php else: ?>
          <div id="transcript-short">
            <p class="text-gray-600 leading-relaxed font-serif text-sm italic"><?= htmlspecialchars(first_n_words($transcript, 80)) ?></p>
            <button id="transcript-expand" class="mt-3 text-xs font-semibold text-navy hover:underline">Read full transcript ↓</button>
          </div>
          <div id="transcript-full" class="hidden">
            <p class="text-gray-600 leading-relaxed font-serif text-sm italic whitespace-pre-line"><?= htmlspecialchars($transcript) ?></p>
            <button id="transcript-collapse" class="mt-3 text-xs font-semibold text-navy hover:underline">Collapse ↑</button>
          </div>
          <?php endif; ?>
        </div>

        <!-- Mobile: next/prev lesson nav -->
        <div class="lg:hidden flex items-center justify-between pt-6 border-t border-gray-100 mt-2">
          <?php if ($lesson_number > 1): ?>
          <a href="/expert-class/<?= $class_slug ?>/lesson/<?= $lesson_number - 1 ?>" class="flex items-center gap-2 text-sm font-semibold text-navy">
            ← Lesson <?= $lesson_number - 1 ?>
          </a>
          <?php else: ?>
          <span></span>
          <?php endif; ?>
          <?php if ($lesson_number < $class['lesson_count']): ?>
          <a href="/expert-class/<?= $class_slug ?>/lesson/<?= $lesson_number + 1 ?>" class="flex items-center gap-2 text-sm font-semibold text-navy">
            Lesson <?= $lesson_number + 1 ?> →
          </a>
          <?php endif; ?>
        </div>

      </main>

      <!-- ═══════════════════════════════════════════════════════════════
           RIGHT SIDEBAR — Learning Tools
      ════════════════════════════════════════════════════════════════ -->
      <aside class="hidden lg:block">
        <div class="sticky top-24 space-y-4">

          <!-- AI Practice Button -->
          <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-xs font-display font-600 uppercase tracking-widest text-gray-400">AI Practice</h3>
              <span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full font-medium flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Locked
              </span>
            </div>
            <p class="text-xs text-gray-500 leading-relaxed mb-4">Practice applying concepts from this lesson with an AI partner trained on <?= htmlspecialchars(explode(' ', $class['expert_name'])[0]) ?>'s frameworks.</p>
            <button onclick="document.getElementById('ai-modal').classList.remove('hidden')"
                    class="w-full flex items-center justify-center gap-2 bg-gray-100 text-gray-400 text-sm font-semibold py-3 rounded-lg cursor-pointer hover:bg-gray-200 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
              Chat with AI Practice
            </button>
          </div>

          <!-- Learner Guide Panel -->
          <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="flex border-b border-gray-200">
              <button id="tab-prepare" onclick="switchTab('prepare')"
                      class="flex-1 py-3 text-xs font-display font-600 uppercase tracking-widest transition-colors bg-white text-navy border-b-2 border-navy">
                Prepare
              </button>
              <button id="tab-practice" onclick="switchTab('practice')"
                      class="flex-1 py-3 text-xs font-display font-600 uppercase tracking-widest transition-colors text-gray-400 hover:text-gray-600">
                Practice
              </button>
              <button id="tab-resources" onclick="switchTab('resources')"
                      class="flex-1 py-3 text-xs font-display font-600 uppercase tracking-widest transition-colors text-gray-400 hover:text-gray-600">
                Resources
              </button>
            </div>

            <!-- Prepare tab -->
            <div id="panel-prepare" class="p-4">
              <p class="text-xs font-semibold text-gray-900 mb-3">Reflection Prompts</p>
              <?php $visible_prompts = $is_locked ? array_slice($prompts, 0, 1) : $prompts; ?>
              <?php foreach ($visible_prompts as $prompt): ?>
              <div class="mb-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                <p class="text-xs text-gray-600 leading-relaxed"><?= htmlspecialchars($prompt) ?></p>
              </div>
              <?php endforeach; ?>

              <?php if ($is_locked && count($prompts) > 1): ?>
              <div class="p-3 bg-gray-50 rounded-lg border border-gray-100 border-dashed flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <p class="text-xs text-gray-400"><?= count($prompts) - 1 ?> more prompts unlocked with full access</p>
              </div>
              <?php endif; ?>

              <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-400">Learner Guide</span>
                <button onclick="document.getElementById('ai-modal').classList.remove('hidden')"
                        class="flex items-center gap-1 text-xs text-gray-400 hover:text-gray-600">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                  Download
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </button>
              </div>
            </div>

            <!-- Practice tab -->
            <div id="panel-practice" class="p-4 hidden">
              <p class="text-xs font-semibold text-gray-900 mb-3">Application Exercises</p>
              <div class="p-3 bg-gray-50 rounded-lg border border-gray-100 mb-3">
                <p class="text-xs text-gray-600 leading-relaxed">Apply today's learning with a guided 48-hour challenge designed around <?= htmlspecialchars(explode(' ', $class['expert_name'])[0]) ?>'s core framework.</p>
              </div>
              <?php if ($is_locked): ?>
              <div class="p-3 bg-gray-50 rounded-lg border border-gray-100 border-dashed flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <p class="text-xs text-gray-400">Full exercises available with Big Think+ access</p>
              </div>
              <?php endif; ?>
            </div>

            <!-- Resources tab -->
            <div id="panel-resources" class="p-4 hidden">
              <p class="text-xs font-semibold text-gray-900 mb-3">Additional Resources</p>
              <div class="space-y-2">
                <button onclick="document.getElementById('ai-modal').classList.remove('hidden')"
                        class="w-full flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100 hover:bg-gray-100 transition-colors text-left">
                  <div class="w-8 h-8 rounded-lg bg-navy/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-gray-700">Discussion Guide</p>
                    <p class="text-xs text-gray-400">Team conversation prompts</p>
                  </div>
                  <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Persistent request demo CTA -->
          <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 text-center">
            <p class="text-sm font-semibold text-gray-900 mb-1">Want the full experience?</p>
            <p class="text-xs text-gray-500 mb-4">Unlock all Expert Classes, AI practice, and learner tools.</p>
            <a href="https://bigthink.com/plus/request-demo/" target="_blank"
               class="block bg-navy text-white text-xs font-semibold py-2.5 px-4 rounded-full hover:bg-navy-dark transition-colors">
              Request a Demo
            </a>
          </div>

        </div>
      </aside>
    </div>
  </div>
</div>

<!-- ── AI PRACTICE MODAL ─────────────────────────────────────────────── -->
<div id="ai-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative">
    <button onclick="document.getElementById('ai-modal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <div class="w-14 h-14 bg-navy/8 rounded-2xl flex items-center justify-center mb-5">
      <svg class="w-7 h-7 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
    </div>
    <h3 class="font-serif text-2xl font-bold text-navy mb-2">AI Practice Partner</h3>
    <p class="text-gray-600 text-sm leading-relaxed mb-2">
      The AI Practice Partner lets you apply concepts from each lesson through structured conversation — role-playing scenarios, getting feedback on your thinking, and deepening understanding of <?= htmlspecialchars(explode(' ', $class['expert_name'])[0]) ?>'s frameworks.
    </p>
    <p class="text-gray-500 text-sm leading-relaxed mb-6">
      This feature is available to Big Think+ subscribers. Request a demo to see AI Practice in action.
    </p>
    <a href="https://bigthink.com/plus/request-demo/" target="_blank"
       class="block w-full text-center bg-navy text-white font-semibold py-3.5 rounded-full hover:bg-navy-dark transition-colors mb-3">
      Request a Demo
    </a>
    <button onclick="document.getElementById('ai-modal').classList.add('hidden')"
            class="block w-full text-center text-sm text-gray-400 hover:text-gray-600 transition-colors py-2">
      Continue browsing
    </button>
  </div>
</div>

<script>
function switchTab(tab) {
  ['prepare','practice','resources'].forEach(function(t) {
    document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
    var btn = document.getElementById('tab-' + t);
    if (t === tab) {
      btn.classList.add('text-navy','border-b-2','border-navy','bg-white');
      btn.classList.remove('text-gray-400');
    } else {
      btn.classList.remove('text-navy','border-b-2','border-navy','bg-white');
      btn.classList.add('text-gray-400');
    }
  });
}

var expandBtn  = document.getElementById('transcript-expand');
var collapseBtn = document.getElementById('transcript-collapse');
if (expandBtn) {
  expandBtn.addEventListener('click', function() {
    document.getElementById('transcript-short').classList.add('hidden');
    document.getElementById('transcript-full').classList.remove('hidden');
  });
}
if (collapseBtn) {
  collapseBtn.addEventListener('click', function() {
    document.getElementById('transcript-full').classList.add('hidden');
    document.getElementById('transcript-short').classList.remove('hidden');
  });
}
</script>

<?php include __DIR__ . '/../includes/lesson-footer.php'; ?>
