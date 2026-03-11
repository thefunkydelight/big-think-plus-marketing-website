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
        'bt-text': '#222222',
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
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700;900&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body class="font-sans bg-white text-bt-text antialiased">

<?php
require_once __DIR__ . '/../data/data.php';
$nav_domains = bt_domains();
?>

<!-- ── NAVIGATION ──────────────────────────────────────────────────── -->
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 transition-shadow duration-200">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo -->
      <a href="/" class="flex items-center flex-shrink-0 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 138 28" fill="currentColor" class="h-6 w-auto">
          <path d="M117.155 6.80376L112.825 13.9996L117.155 21.1962H113.807L110.493 15.4921H108.198V21.1962H105.093V6.80376H108.195V12.5619L110.458 12.5555L113.807 6.80163L117.155 6.80376ZM58.0057 21.1962H61.1107V9.67786H65.9429V6.80376H53.1756V9.67786H58.0071L58.0057 21.1962ZM70.9164 15.4367H77.3V21.1962H80.4051V6.80376H77.3029V12.5626H70.9193V6.80376H67.8142V21.1962H70.9164V15.4367ZM86.2443 6.80376H83.1421V21.1962H86.1984L86.2443 6.80376ZM92.0857 21.1962V11.0282H92.4902L98.3717 21.1962H102.442V6.80376H99.3408V16.9711H98.9298L93.0482 6.80376H88.9835V21.1962H92.0857ZM53.1742 27.9993H117.154V25.1252H53.1742V27.9993ZM32.5257 21.3816C35.4772 21.3816 36.7073 19.8189 37.218 18.7768H37.6197V21.1977H40.077V12.5626H32.5063V15.4367H36.8816C36.8457 15.9936 36.6227 16.5782 36.4018 16.8965C35.8853 17.6388 34.6351 18.5054 32.8104 18.5054C30.1429 18.5054 28.334 16.5875 28.334 14.0458C28.334 11.5042 30.2125 9.49387 32.8685 9.49387C34.326 9.49387 35.6537 10.2895 36.1909 10.8237L36.3042 10.9359L38.2968 8.80838L38.1935 8.70538C36.8873 7.39904 34.9048 6.61907 32.8908 6.61907C28.4437 6.61907 25.0862 9.61676 25.0862 14.0067C25.0862 18.4862 28.4932 21.3816 32.5257 21.3816ZM13.2787 21.1977H7.05427V6.80376H13.5857C16.5343 6.80376 18.3662 8.22447 18.3662 10.5047C18.3662 13.1494 16.0215 13.6004 14.6364 13.6004V14.1261C15.5467 14.1261 18.76 14.6617 18.76 17.3504C18.7607 19.9609 16.8141 21.1962 13.2787 21.1962V21.1977ZM10.1564 12.5313H13.3683C14.4894 12.5313 15.2719 11.941 15.2719 11.0957C15.2719 10.1048 14.5547 9.62245 13.0678 9.62245H10.1564V12.5313ZM13.2693 18.2468C14.8566 18.2468 15.6277 17.7652 15.6277 16.7743C15.6277 15.9837 14.7247 15.4956 13.2715 15.4956H10.1851V18.2504L13.2693 18.2468ZM20.4807 21.209H23.4932V21.1962H23.5391V6.80376H20.4312V21.1962H20.4771L20.4807 21.209ZM47.1198 0H47.1241V28H0V0H47.1198ZM44.2228 2.87409H2.90204V25.1259H44.2228V2.87409ZM137.714 13.2318H131.224V6.80376H129.672V13.2318H123.182V14.7682H129.672V21.1962H131.224V14.7682H137.714V13.2318Z"/>
        </svg>
        <span class="sr-only">Big Think Plus</span>
      </a>

      <!-- Desktop nav links -->
      <div class="hidden lg:flex items-center gap-1">

        <!-- Leadership Domains dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black rounded transition-colors">
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
              <a href="/#domains" class="text-xs font-semibold text-navy hover:underline">View all domains &rarr;</a>
            </div>
          </div>
        </div>

        <!-- Content dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black rounded transition-colors">
            Content
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-52 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="https://bigthink.com/plus/our-approach/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Our Approach</a>
            <a href="https://bigthink.com/plus/experts/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Experts</a>
            <a href="https://bigthink.com/plus/content-library/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Library</a>
          </div>
        </div>

        <!-- Platform dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black rounded transition-colors">
            Platform
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-64 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="https://bigthink.com/plus/platform/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Platform Overview</a>
            <a href="https://bigthink.com/plus/integrations/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Integrations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Analytics</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Curations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Assessments</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Recommendations</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Transcription &amp; Translation</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Instructional Design</a>
          </div>
        </div>

        <!-- Learn dropdown -->
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black rounded transition-colors">
            Learn
            <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="dropdown-menu absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
            <a href="https://bigthink.com/plus/how-to-make-a-leader-podcast/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">How to Make a Leader</a>
            <a href="https://bigthink.com/plus/blog/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">BT+ Blog</a>
            <a href="https://bigthink.com/plus/sample-lessons/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Sample Lessons</a>
            <a href="https://bigthink.com/plus/customer-stories/" target="_blank" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Customer Stories</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">E-books</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Newsletter</a>
            <a href="#" class="dropdown-item block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black">Events</a>
          </div>
        </div>

      </div>

      <!-- Right side: Login + CTA -->
      <div class="hidden lg:flex items-center gap-4">
        <a href="#" class="text-sm font-medium text-gray-700 hover:text-black transition-colors">Login</a>
        <a href="https://bigthink.com/plus/request-demo/" target="_blank"
           class="inline-flex items-center border-2 border-black text-black text-sm font-bold px-5 py-2 rounded-full hover:bg-black hover:text-white transition-colors whitespace-nowrap uppercase tracking-wide">
          Request Demo
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
      <a href="/domains/<?= $nd['slug'] ?>" class="block py-2 text-sm font-medium text-gray-700 hover:text-black"><?= htmlspecialchars($nd['title']) ?></a>
      <?php endforeach; ?>
      <div class="pt-3 border-t border-gray-100">
        <a href="https://bigthink.com/plus/request-demo/" target="_blank"
           class="block w-full text-center border-2 border-black text-black text-sm font-bold px-5 py-3 rounded-full mt-2 uppercase hover:bg-black hover:text-white transition-colors">
          Request Demo
        </a>
      </div>
    </div>
  </div>
</nav>

<div class="pt-16"><!-- nav spacer -->
