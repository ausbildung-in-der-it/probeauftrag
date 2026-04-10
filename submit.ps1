# LearnHub Probeauftrag — Submission Script (Windows PowerShell)
# Creates a zip file without vendor/, node_modules/, and other build artifacts.

$timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
$name = "learnhub-abgabe-$timestamp"
$output = "$name.zip"

Write-Host "Erstelle Abgabe-ZIP: $output" -ForegroundColor Cyan
Write-Host ""

# Directories and patterns to exclude
$excludeDirs = @(
    "vendor",
    "node_modules",
    "public\build",
    "storage\framework\cache\data",
    "storage\framework\sessions",
    "storage\framework\views",
    "storage\logs",
    "bootstrap\cache",
    ".phpunit.cache"
)

$excludeFiles = @(
    ".DS_Store",
    "public\hot"
)

# Get all files, excluding specified directories and files
$files = Get-ChildItem -Path . -Recurse -File | Where-Object {
    $relativePath = $_.FullName.Substring((Get-Location).Path.Length + 1)

    # Check if file is in an excluded directory
    $inExcludedDir = $false
    foreach ($dir in $excludeDirs) {
        if ($relativePath -like "$dir\*" -or $relativePath -like "$dir/*") {
            $inExcludedDir = $true
            break
        }
    }

    # Check if file matches excluded file patterns
    $isExcludedFile = $false
    foreach ($file in $excludeFiles) {
        if ($relativePath -eq $file -or $relativePath -like "*\.DS_Store") {
            $isExcludedFile = $true
            break
        }
    }

    # Also exclude any existing zip files
    $isZip = $relativePath -like "*.zip"

    -not $inExcludedDir -and -not $isExcludedFile -and -not $isZip
}

# Create zip
Compress-Archive -Path $files.FullName -DestinationPath $output -Force

$size = (Get-Item $output).Length / 1MB
Write-Host ""
Write-Host "Fertig! Datei: $output" -ForegroundColor Green
Write-Host ("Groesse: {0:N1} MB" -f $size)
Write-Host ""
Write-Host "Vergiss nicht, auch den OpenCode Session-Export beizufuegen!" -ForegroundColor Yellow
Write-Host "  -> opencode export"
