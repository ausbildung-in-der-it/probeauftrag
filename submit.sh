#!/usr/bin/env bash
set -euo pipefail

# LearnHub Probeauftrag — Submission Script
# Creates a zip file without vendor/, node_modules/, and other build artifacts.

NAME="learnhub-abgabe-$(date +%Y%m%d-%H%M%S)"
OUTPUT="${NAME}.zip"

echo "Erstelle Abgabe-ZIP: ${OUTPUT}"
echo ""

zip -r "${OUTPUT}" . \
    -x "vendor/*" \
    -x "node_modules/*" \
    -x "public/build/*" \
    -x "public/hot" \
    -x "storage/framework/cache/data/*" \
    -x "storage/framework/sessions/*" \
    -x "storage/framework/views/*" \
    -x "storage/logs/*" \
    -x "bootstrap/cache/*" \
    -x ".phpunit.cache/*" \
    -x ".DS_Store" \
    -x "*.zip"

echo ""
echo "Fertig! Datei: ${OUTPUT}"
echo "Groesse: $(du -h "${OUTPUT}" | cut -f1)"
echo ""
echo "Vergiss nicht, auch den OpenCode Session-Export beizufuegen!"
echo "  -> opencode export"
