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

<!-- ── LESSON NAV (compact) ───────────────────────────────────────── -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 h-14">
  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 h-full flex items-center justify-between gap-4">
    <!-- Logo -->
    <a href="/" class="flex items-center flex-shrink-0 text-black">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 138 28" fill="currentColor" class="h-5 w-auto">
        <path d="M117.155 6.80376L112.825 13.9996L117.155 21.1962H113.807L110.493 15.4921H108.198V21.1962H105.093V6.80376H108.195V12.5619L110.458 12.5555L113.807 6.80163L117.155 6.80376ZM58.0057 21.1962H61.1107V9.67786H65.9429V6.80376H53.1756V9.67786H58.0071L58.0057 21.1962ZM70.9164 15.4367H77.3V21.1962H80.4051V6.80376H77.3029V12.5626H70.9193V6.80376H67.8142V21.1962H70.9164V15.4367ZM86.2443 6.80376H83.1421V21.1962H86.1984L86.2443 6.80376ZM92.0857 21.1962V11.0282H92.4902L98.3717 21.1962H102.442V6.80376H99.3408V16.9711H98.9298L93.0482 6.80376H88.9835V21.1962H92.0857ZM53.1742 27.9993H117.154V25.1252H53.1742V27.9993ZM32.5257 21.3816C35.4772 21.3816 36.7073 19.8189 37.218 18.7768H37.6197V21.1977H40.077V12.5626H32.5063V15.4367H36.8816C36.8457 15.9936 36.6227 16.5782 36.4018 16.8965C35.8853 17.6388 34.6351 18.5054 32.8104 18.5054C30.1429 18.5054 28.334 16.5875 28.334 14.0458C28.334 11.5042 30.2125 9.49387 32.8685 9.49387C34.326 9.49387 35.6537 10.2895 36.1909 10.8237L36.3042 10.9359L38.2968 8.80838L38.1935 8.70538C36.8873 7.39904 34.9048 6.61907 32.8908 6.61907C28.4437 6.61907 25.0862 9.61676 25.0862 14.0067C25.0862 18.4862 28.4932 21.3816 32.5257 21.3816ZM13.2787 21.1977H7.05427V6.80376H13.5857C16.5343 6.80376 18.3662 8.22447 18.3662 10.5047C18.3662 13.1494 16.0215 13.6004 14.6364 13.6004V14.1261C15.5467 14.1261 18.76 14.6617 18.76 17.3504C18.7607 19.9609 16.8141 21.1962 13.2787 21.1962V21.1977ZM10.1564 12.5313H13.3683C14.4894 12.5313 15.2719 11.941 15.2719 11.0957C15.2719 10.1048 14.5547 9.62245 13.0678 9.62245H10.1564V12.5313ZM13.2693 18.2468C14.8566 18.2468 15.6277 17.7652 15.6277 16.7743C15.6277 15.9837 14.7247 15.4956 13.2715 15.4956H10.1851V18.2504L13.2693 18.2468ZM20.4807 21.209H23.4932V21.1962H23.5391V6.80376H20.4312V21.1962H20.4771L20.4807 21.209ZM47.1198 0H47.1241V28H0V0H47.1198ZM44.2228 2.87409H2.90204V25.1259H44.2228V2.87409ZM137.714 13.2318H131.224V6.80376H129.672V13.2318H123.182V14.7682H129.672V21.1962H131.224V14.7682H137.714V13.2318Z"/>
      </svg>
      <span class="sr-only">Big Think Plus</span>
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
      <a href="/domains/<?= $class['domain'] ?>" class="hidden sm:flex items-center gap-1 text-xs text-gray-500 hover:text-black transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        All Classes
      </a>
      <?php endif; ?>
      <a href="https://bigthink.com/plus/request-demo/" target="_blank"
         class="inline-flex items-center border-2 border-black text-black text-xs font-bold px-4 py-1.5 rounded-full hover:bg-black hover:text-white transition-colors whitespace-nowrap uppercase tracking-wide">
        Request Demo
      </a>
    </div>
  </div>
</nav>

<div class="pt-14"><!-- nav spacer -->
