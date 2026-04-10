# Probeauftrag: LearnHub Quiz-Modul

Willkommen zum Probeauftrag! Du arbeitest an **LearnHub**, einer E-Learning-Plattform mit einem Quiz-Modul. Die Anwendung hat bereits grundlegende Quiz-Funktionalität — deine Aufgabe ist es, Bugs zu fixen, Tests zu schreiben und ein neues Feature zu entwickeln.

## Worum es geht

Bei diesem Probeauftrag geht es **nicht** darum, Experte in Laravel, Vue oder irgendeiner der eingesetzten Technologien zu sein. Es geht darum, wie du mit einem AI-Coding-Agent arbeitest:

- **Nutze den Agent, um dich im Projekt zurechtzufinden.** Du landest in einer unbekannten Codebase — lass dir vom Agent erklären, wie das Projekt aufgebaut ist, welche Patterns verwendet werden und wo du ansetzen musst.
- **Nutze den Agent, um Technologien zu verstehen.** Du kennst Laravel nicht gut genug? Kein Problem — lass dir vom Agent die relevante Dokumentation suchen und die Konzepte erklären.
- **Nutze den Agent als Sparringspartner.** Diskutiere Lösungsansätze, lass dir Vor- und Nachteile aufzeigen, bevor du implementierst.
- **Steuere den Prozess, nicht jede Codezeile.** Deine Aufgabe ist es, den Agent sinnvoll zu instruieren, die Ergebnisse zu prüfen und Entscheidungen zu treffen — nicht alles selbst zu tippen.

Wir bewerten vor allem **deine Vorgehensweise und wie du den Agent einsetzt**, nicht ob du jede Technologie auswendig kennst.

## Tech-Stack

| Technologie | Version | Verwendung |
|-------------|---------|------------|
| Laravel | 13 | PHP-Backend |
| Inertia.js | v3 | SPA-Bridge zwischen Backend und Frontend |
| Vue 3 | Composition API | Frontend-Framework |
| TypeScript | strict | Typisierung im Frontend |
| Tailwind CSS | v4 | Styling |
| Pest | v4 | Testing |
| SQLite | — | Datenbank |
| Laravel Boost | v2 | MCP-Server (AI-Tooling) |
| Wayfinder | v0 | Typisierte Route-Funktionen |

---

## 1. Voraussetzungen installieren

Du brauchst PHP 8.4, Composer, Node.js und SQLite. Falls du das noch nicht eingerichtet hast:

**Empfohlen — Laravel Herd (macOS/Windows):**
Herd installiert PHP, Composer und alles Nötige in einem Schritt: [https://herd.laravel.com](https://herd.laravel.com)

**Alternativ — manuell:**
- PHP 8.4 mit SQLite-Extension (`php -m | grep sqlite`)
- [Composer](https://getcomposer.org/download/)
- [Node.js 20+](https://nodejs.org/) (mit npm)

---

## 2. Projekt einrichten

```bash
# Dependencies installieren
composer install
npm install

# Environment-Datei erstellen
cp .env.example .env
php artisan key:generate

# Datenbank erstellen und befüllen
touch database/database.sqlite
php artisan migrate --seed

# Frontend bauen
npm run build

# Entwicklungsserver starten
composer run dev
```

**Login-Daten für den Test-Account:**
- E-Mail: `test@example.com`
- Passwort: `password`

Öffne [http://localhost:8000](http://localhost:8000) im Browser und logge dich ein. Unter "Quizzes" in der Sidebar findest du das Quiz-Modul.

---

## 3. OpenCode einrichten

Du arbeitest in diesem Probeauftrag mit **[OpenCode](https://opencode.ai)** — einem AI-gestützten Coding-Agent im Terminal. Deine gesamte Arbeit soll in **einer OpenCode-Session** stattfinden, damit wir deinen Arbeitsprozess nachvollziehen können.

### Installation

```bash
# macOS / Linux (Homebrew)
brew install anomalyco/tap/opencode

# Linux (curl)
curl -fsSL https://opencode.ai/install | bash

# Windows (empfohlen: WSL nutzen, dann Linux-Installation)
# Alternativ:
choco install opencode
# oder
scoop install opencode
```

### Mit OpenRouter verbinden

1. Starte OpenCode im Projektverzeichnis:
   ```bash
   cd /pfad/zum/projekt
   opencode
   ```

2. Verbinde dich mit OpenRouter:
   - Tippe `/connect` ein
   - Suche nach **OpenRouter** und wähle es aus
   - Gib den **API-Key** ein, den du per Mail erhalten hast

3. Wähle ein Modell:
   - Tippe `/models` ein, um verfügbare Modelle zu sehen
   - Mit `Ctrl+T` kannst du jederzeit zwischen Modellen wechseln

### Empfohlene Modelle

Du hast ein Budget von **$10 auf OpenRouter**. Probiere verschiedene Modelle aus und finde heraus, welches für welche Aufgabe am besten funktioniert:

| Modell | Stärken |
|--------|---------|
| **Kimi K2.5** | Gutes Allround-Modell, günstig |
| **GLM-5** | Stark bei Code-Generierung |
| **GLM-5.1** | Verbesserte Version von GLM-5 |
| **Mimo-V2-Pro** | Spezialisiert auf Code |
| **Mimo-V2-Omni** | Multimodal, versteht auch Screenshots |
| **MiniMax M2.5** | Schnell und effizient |
| **MiniMax M2.7** | Neueste MiniMax-Version |

### Nützliche OpenCode-Befehle

| Befehl | Funktion |
|--------|----------|
| `/connect` | Provider hinzufügen |
| `/models` | Verfügbare Modelle anzeigen |
| `/export` | Session exportieren |
| `/undo` | Letzte Änderung rückgängig machen |
| `/redo` | Rückgängig gemachte Änderung wiederherstellen |
| `Ctrl+T` | Modell wechseln |
| `@dateiname` | Datei als Kontext referenzieren |
| `Tab` | Zwischen Plan- und Build-Modus wechseln |

### Tipps für agentisches Arbeiten

- **Orientiere dich zuerst**: Lass den Agent die Projektstruktur erkunden, bevor du loslegst. Ein guter erster Prompt: *"Verschaffe dir einen Überblick über das Projekt und das Quiz-Modul."*
- **Laravel Boost ist vorkonfiguriert**: Das Projekt hat Laravel Boost als MCP-Server eingerichtet — der Agent kann damit direkt Datenbank-Queries ausführen, Doku durchsuchen und Fehler-Logs lesen. Du musst dafür nichts einrichten.
- **Klare Instruktionen**: Je präziser deine Anweisungen, desto besser das Ergebnis. Statt *"Fix den Bug"* lieber *"Analysiere, warum unveröffentlichte Quizze in der Liste auftauchen, und schlage einen Fix vor."*
- **Iterativ arbeiten**: Lass den Agent erst analysieren, dann implementieren, dann testen — nicht alles auf einmal.
- **Tests ausführen**: `php artisan test --compact` nach jeder Änderung.
- **Verschiedene Modelle für verschiedene Aufgaben**: Manche Modelle sind besser für Analyse, andere für Code-Generierung. Experimentiere!

---

## Deine Aufgaben

Du hast **ca. 2 Stunden** Zeit. Arbeite die Aufgaben der Reihe nach ab.

### Aufgabe 1: Bug Fix (ca. 30 Minuten)

Uns haben mehrere Bug-Reports von Nutzern erreicht. Hier die Zusammenfassung aus dem Support-Kanal:

> *"Ich sehe in der Quiz-Übersicht ein Quiz mit '(ENTWURF)' im Titel. Das sollte doch noch gar nicht sichtbar sein, oder?"*
>
> *"Die Fragen in den Quizzen kommen irgendwie in komischer Reihenfolge. Mal ist Frage 3 oben, mal Frage 1."*
>
> *"Ich hab einem Freund einen Quiz-Link geschickt und der konnte das Quiz sehen, obwohl er keinen Account hat. Ist das so gewollt?"*

Finde die Ursachen für diese Probleme im Code und behebe sie. Schreibe außerdem mindestens einen Regressionstest, damit diese Bugs nicht erneut auftreten.

---

### Aufgabe 2: Tests schreiben (ca. 30 Minuten)

Das Quiz-Modul hat aktuell **keine Tests**. Schreibe aussagekräftige Feature-Tests mit Pest, die das korrekte Verhalten der Quiz-Funktionalität sicherstellen.

Überlege dir selbst, welche Szenarien getestet werden sollten — sowohl Happy Paths als auch Edge Cases.

**Hinweise:**
- Erstelle Tests mit: `php artisan make:test --pest QuizTest`
- Nutze die vorhandenen Factories (`QuizFactory`, `QuestionFactory`, `AnswerFactory`)
- Führe Tests aus mit: `php artisan test --compact --filter=Quiz`

---

### Aufgabe 3: Neues Feature — Quiz-Teilnahme (ca. 60 Minuten)

Nutzer sollen ein Quiz **aktiv durchführen** und ihre Ergebnisse sehen können.

**Anforderungen:**

1. **Datenbank**: Erstelle die nötigen Tabellen, um Quiz-Versuche und gegebene Antworten zu speichern
2. **Quiz durchführen**: Auf der Quiz-Detailseite soll ein "Quiz starten"-Button erscheinen. Der Nutzer beantwortet die Fragen und klickt auf "Abschicken"
3. **Auswertung**: Nach dem Abschicken wird die Punktzahl berechnet (richtige Antworten / Gesamtfragen) und eine Ergebnisseite angezeigt
4. **Verlauf**: Nutzer können ihre bisherigen Versuche sehen (wann, welches Quiz, welche Punktzahl)

**Hinweise:**
- Denke über die Datenbank-Struktur nach (welche Models/Tabellen brauchst du?)
- Nutze Inertia-Forms (`useForm`) für das Abschicken der Antworten
- Schreibe mindestens einen Test für die Punkteberechnung
- Vergiss nicht: `vendor/bin/pint --dirty` und `php artisan test --compact` am Ende

---

## Abgabe

### Option A: Git-Repository (bevorzugt)

Erstelle ein **neues, eigenes** Git-Repository (NICHT forken!) und pushe deinen Code:

```bash
# Git initialisieren (falls noch nicht geschehen)
git init
git add -A
git commit -m "Initial commit"

# Neues Repository auf GitHub erstellen, dann:
git remote add origin https://github.com/DEIN-USER/learnhub-probeauftrag.git
git branch -M main
git push -u origin main
```

> **Wichtig:** Erstelle ein eigenes Repository. Bitte NICHT forken, da andere Bewerber sonst sehen könnten, wer sich ebenfalls beworben hat. Teile uns den Link zum Repository per Mail mit.

### Option B: ZIP-Datei

Nutze das mitgelieferte Script:

```bash
# Linux / macOS
./submit.sh

# Windows (PowerShell)
.\submit.ps1
```

Das Script erstellt eine ZIP-Datei ohne `vendor/`, `node_modules/` und andere Build-Artefakte.

### OpenCode Session-Export (PFLICHT)

Exportiere deine **gesamte OpenCode-Session**, damit wir deinen Arbeitsprozess nachvollziehen können:

```bash
# Im OpenCode-TUI:
/export

# Oder auf der Kommandozeile:
opencode export
```

Die exportierte Datei muss mit abgegeben werden (entweder ins Repository committen oder zur ZIP-Datei hinzufügen).

### Notizen zur Vorgehensweise

Schreibe kurze Notizen zu deinem Vorgehen in eine Datei `NOTES.md`:

- Wie bist du an die Aufgaben herangegangen?
- Welche Modelle hast du ausprobiert? Welches war am besten für welche Aufgabe?
- Welche Entscheidungen hast du getroffen und warum?
- Was würdest du anders machen, wenn du mehr Zeit hättest?

---

## Was wir bewerten

| Kriterium | Was wir uns anschauen |
|-----------|----------------------|
| **Vorgehensweise** | Wie orientierst du dich in einem neuen Projekt? Analysierst du erst oder legst du direkt los? |
| **Agentisches Arbeiten** | Wie instruierst du den AI-Agent? Klare Prompts? Iteratives Vorgehen? |
| **Code-Qualität** | Sauberer, lesbarer Code nach Laravel Best Practices? |
| **Testing** | Sinnvolle Tests mit guter Abdeckung? |
| **Produktdenken** | Durchdachte Feature-Implementierung? Gute UX-Entscheidungen? |
| **Tool-Nutzung** | Nutzt du Laravel Boost, Dokumentationssuche und verschiedene Modelle sinnvoll? |

**Viel Erfolg!**
