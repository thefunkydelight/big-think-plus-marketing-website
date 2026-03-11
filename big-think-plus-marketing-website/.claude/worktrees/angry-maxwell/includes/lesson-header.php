<?php if (!isset($page_title)) $page_title = 'Big Think+'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?> | Big Think+</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        navy:  '#0c3d54',
        'navy-dark': '#0a3347',
        'navy-light': '#155270',
        'bt-gold': '#e8a020',
      },
      fontFamily: {
        serif:   ['"Libre Baskerville"', 'Georgia', 'serif'],
        sans:    ['Inter', 'system-ui', 'sans-serif'],
        display: ['Oswald', 'sans-serif'],
      },
    }
  }
}
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body class="font-sans bg-white text-gray-900 antialiased">

<!-- ── LESSON NAV (compact) ───────────────────────────────────────── -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 h-14">
  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 h-full flex items-center justify-between gap-4">
    <!-- Logo -->
    <a href="/" class="flex items-center gap-2 flex-shrink-0">
      <span class="font-display font-700 text-xl tracking-tight text-navy">Big Think+</span>
    </a>

    <!-- Class title (center, truncated) -->
    <div class="hidden md:flex flex-1 items-center justify-center min-w-0 px-4">
      <p class="text-sm font-semibold text-gray-700 truncate"><?= htmlspecialchars($class['title'] ?? '') ?></p>
      <span class="mx-2 text-gray-300">·</span>
      <p class="text-sm text-gray-400 flex-shrink-0"><?= htmlspecialchars($class['expert_name'] ?? '') ?></p>
    </div>

    <!-- Right: back + demo CTA -->
    <div class="flex items-center gap-3 flex-shrink-0">
      <?php if (isset($class['domain'])): ?>
      <a href="/domains/<?= $class['domain'] ?>" class="hidden sm:flex items-center gap-1 text-xs text-gray-500 hover:text-navy transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        All Classes
      </a>
      <?php endif; ?>
      <a href="https://bigthink.com/plus/request-demo/" target="_blank"
         class="inline-flex items-center gap-1.5 bg-navy text-white text-xs font-semibold px-4 py-2 rounded-full hover:bg-navy-dark transition-colors whitespace-nowrap">
        Request a Demo
      </a>
    </div>
  </div>
</nav>

<div class="pt-14"><!-- nav spacer -->
