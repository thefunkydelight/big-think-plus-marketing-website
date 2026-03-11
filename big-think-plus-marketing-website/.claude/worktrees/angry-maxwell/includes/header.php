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

<?php
// Build the domains list for the nav dropdown
require_once __DIR__ . '/../data/data.php';
$nav_domains = bt_domains();
?>

<!-- ── NAVIGATION ──────────────────────────────────────────────────── -->
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 transition-shadow duration-200">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo -->
      <a href="/" class="flex items-center gap-2 flex-shrink-0">
        <span class="font-display font-700 text-2xl tracking-tight text-navy">Big Think<span class="text-navy">+</span></span>
      </a>

      <!-- Desktop nav links -->
      <div class="hidden lg:flex items-center gap-1">

        <!-- Content dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-navy rounded transition-colors">
            Content
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-52 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Our Approach</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Experts</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Library</a>
          </div>
        </div>

        <!-- Platform dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-navy rounded transition-colors">
            Platform
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-60 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Platform Overview</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Recommendations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Integrations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Transcription & Translation</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Analytics</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Instructional Design</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Curations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Assessments</a>
          </div>
        </div>

        <!-- Learn dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-navy rounded transition-colors">
            Learn
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">How to Make a Leader (Podcast)</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Blog</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Sample Lessons</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Customer Stories</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">E-Books</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Newsletter</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-navy">Events</a>
          </div>
        </div>

        <!-- ★ LEADERSHIP DOMAINS DROPDOWN (NEW) -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-semibold text-navy border-b-2 border-navy rounded transition-colors">
            Leadership Domains
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu domains-mega absolute top-full left-0 mt-1 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <p class="px-4 pb-2 text-xs font-display font-600 text-gray-400 uppercase tracking-widest">Browse by Domain</p>
            <?php foreach ($nav_domains as $nd): ?>
            <a href="/domains/<?= $nd['slug'] ?>" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group/item">
              <span class="mt-0.5 flex-shrink-0 w-7 h-7 rounded-md bg-navy/10 flex items-center justify-center">
                <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
              </span>
              <div>
                <p class="text-sm font-semibold text-gray-900 group-hover/item:text-navy"><?= htmlspecialchars($nd['title']) ?></p>
                <p class="text-xs text-gray-400 mt-0.5 line-clamp-1"><?= htmlspecialchars($nd['description']) ?></p>
              </div>
            </a>
            <?php endforeach; ?>
            <div class="px-4 pt-2 border-t border-gray-100 mt-1">
              <a href="/#domains" class="text-xs font-semibold text-navy hover:underline">View all domains →</a>
            </div>
          </div>
        </div>

      </div>

      <!-- Right side: Login + CTA -->
      <div class="hidden lg:flex items-center gap-4">
        <a href="#" class="text-sm font-medium text-gray-700 hover:text-navy transition-colors">Login</a>
        <a href="https://bigthink.com/plus/request-demo/" target="_blank"
           class="inline-flex items-center gap-1.5 bg-navy text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-navy-dark transition-colors whitespace-nowrap">
          Request a Demo
        </a>
      </div>

      <!-- Mobile hamburger -->
      <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 bg-white px-6 pb-4">
    <div class="pt-3 space-y-1">
      <?php foreach ($nav_domains as $nd): ?>
      <a href="/domains/<?= $nd['slug'] ?>" class="block py-2 text-sm font-medium text-gray-700 hover:text-navy"><?= htmlspecialchars($nd['title']) ?></a>
      <?php endforeach; ?>
      <div class="pt-3 border-t border-gray-100">
        <a href="https://bigthink.com/plus/request-demo/" target="_blank"
           class="block w-full text-center bg-navy text-white text-sm font-semibold px-5 py-3 rounded-full mt-2">
          Request a Demo
        </a>
      </div>
    </div>
  </div>
</nav>

<div class="pt-16"><!-- nav spacer -->
