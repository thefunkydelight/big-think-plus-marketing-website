<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

// Serve static assets directly
if (preg_match('/\.(css|js|png|jpg|gif|svg|ico|woff|woff2|ttf|webp)$/i', $uri)) {
    return false;
}

if ($uri === '/') {
    require __DIR__ . '/index.php';
} elseif (preg_match('#^/domains/([a-z0-9-]+)$#', $uri, $m)) {
    $_GET['domain_slug'] = $m[1];
    require __DIR__ . '/pages/domain.php';
} elseif (preg_match('#^/expert-class/([a-z0-9-]+)/lesson/(\d+)$#', $uri, $m)) {
    $_GET['class_slug'] = $m[1];
    $_GET['lesson_number'] = (int)$m[2];
    require __DIR__ . '/pages/lesson.php';
} else {
    http_response_code(404);
    echo '<h1>404 Not Found</h1><a href="/">Home</a>';
}
