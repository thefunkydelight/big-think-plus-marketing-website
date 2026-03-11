#!/bin/bash
# Big Think+ Prototype — Static build for Netlify
# Renders each PHP page to static HTML using the PHP CLI server.

set -e
BASE_DIR="$(cd "$(dirname "$0")" && pwd)"
OUT="$BASE_DIR/_site"
PORT=9191

echo "🔨 Building Big Think+ prototype..."

# Clean output directory
rm -rf "$OUT"
mkdir -p "$OUT"

# Start PHP built-in server in background
php -S "localhost:$PORT" "$BASE_DIR/router.php" -t "$BASE_DIR" &>/dev/null &
SERVER_PID=$!
sleep 1.5

fetch() {
  local url="$1"
  local dest="$2"
  mkdir -p "$(dirname "$dest")"
  curl -sf "http://localhost:$PORT$url" -o "$dest" || echo "⚠️  Warning: failed to fetch $url"
}

# ── Homepage ──────────────────────────────────────────────────────────
fetch "/" "$OUT/index.html"

# ── Domain pages ─────────────────────────────────────────────────────
for slug in character-and-integrity customer-and-results-orientation growth-and-change people-and-culture vision-and-strategy; do
  fetch "/domains/$slug" "$OUT/domains/$slug/index.html"
done

# ── Lesson pages — fetch via PHP to get the slug list ────────────────
# We call a helper endpoint that lists all class slugs and lesson counts
SLUGS=$(php -r "
require '${BASE_DIR}/data/data.php';
\$classes = bt_expert_classes();
foreach (\$classes as \$c) {
    echo \$c['slug'] . ':' . \$c['lesson_count'] . PHP_EOL;
}
")

while IFS=: read -r class_slug lesson_count; do
  [ -z "$class_slug" ] && continue
  for n in $(seq 1 "$lesson_count"); do
    url="/expert-class/${class_slug}/lesson/${n}"
    dest="$OUT/expert-class/${class_slug}/lesson/${n}/index.html"
    fetch "$url" "$dest"
  done
done <<< "$SLUGS"

# ── Copy static assets ────────────────────────────────────────────────
cp -r "$BASE_DIR/assets" "$OUT/"

# ── Netlify redirects for clean URLs ─────────────────────────────────
cat > "$OUT/_redirects" << 'EOF'
/domains/:slug          /domains/:slug/index.html    200
/expert-class/*         /expert-class/*              200
EOF

# Stop PHP server
kill $SERVER_PID 2>/dev/null || true

echo "✅ Build complete → $OUT"
echo "   Pages generated: $(find "$OUT" -name '*.html' | wc -l | tr -d ' ')"
