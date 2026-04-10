<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        // Quiz 1: Published — HTML & CSS Grundlagen
        $quiz1 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'HTML & CSS Grundlagen',
            'description' => 'Teste dein Wissen zu den Grundlagen von HTML und CSS.',
            'is_published' => true,
        ]);

        $this->createQuestion($quiz1, 'Welches HTML-Element wird für die Hauptüberschrift verwendet?', 3, [
            ['body' => '<h1>', 'is_correct' => true],
            ['body' => '<header>', 'is_correct' => false],
            ['body' => '<title>', 'is_correct' => false],
            ['body' => '<heading>', 'is_correct' => false],
        ]);

        $this->createQuestion($quiz1, 'Welche CSS-Eigenschaft ändert die Schriftgröße?', 1, [
            ['body' => 'font-size', 'is_correct' => true],
            ['body' => 'text-size', 'is_correct' => false],
            ['body' => 'font-style', 'is_correct' => false],
            ['body' => 'text-font', 'is_correct' => false],
        ]);

        $this->createQuestion($quiz1, 'Was bedeutet CSS?', 2, [
            ['body' => 'Cascading Style Sheets', 'is_correct' => true],
            ['body' => 'Computer Style Sheets', 'is_correct' => false],
            ['body' => 'Creative Style System', 'is_correct' => false],
        ]);

        // Quiz 2: Published — PHP Basics
        $quiz2 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'PHP Grundlagen',
            'description' => 'Grundlegende Fragen zu PHP-Syntax und -Konzepten.',
            'is_published' => true,
        ]);

        $this->createQuestion($quiz2, 'Wie beginnt ein PHP-Block?', 1, [
            ['body' => '<?php', 'is_correct' => true],
            ['body' => '<php>', 'is_correct' => false],
            ['body' => '<?>', 'is_correct' => false],
            ['body' => '<script php>', 'is_correct' => false],
        ]);

        $this->createQuestion($quiz2, 'Welcher Operator wird für die Zeichenkettenverknüpfung verwendet?', 2, [
            ['body' => '.', 'is_correct' => true],
            ['body' => '+', 'is_correct' => false],
            ['body' => '&', 'is_correct' => false],
            ['body' => ',', 'is_correct' => false],
        ]);

        $this->createQuestion($quiz2, 'Wie definiert man eine Variable in PHP?', 3, [
            ['body' => '$variableName', 'is_correct' => true],
            ['body' => 'var variableName', 'is_correct' => false],
            ['body' => 'let variableName', 'is_correct' => false],
        ]);

        // Quiz 3: UNPUBLISHED — Draft quiz (this is the one that should NOT appear in the list)
        $quiz3 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'JavaScript Advanced (ENTWURF)',
            'description' => 'Fortgeschrittene JavaScript-Konzepte — noch in Bearbeitung.',
            'is_published' => false,
        ]);

        $this->createQuestion($quiz3, 'Was ist ein Promise in JavaScript?', 1, [
            ['body' => 'Ein Objekt, das einen zukünftigen Wert repräsentiert', 'is_correct' => true],
            ['body' => 'Eine Variable, die nur einmal gesetzt werden kann', 'is_correct' => false],
            ['body' => 'Ein spezieller Datentyp für Zahlen', 'is_correct' => false],
        ]);
    }

    /**
     * @param  array<int, array{body: string, is_correct: bool}>  $answers
     */
    private function createQuestion(Quiz $quiz, string $body, int $position, array $answers): void
    {
        $question = Question::create([
            'quiz_id' => $quiz->id,
            'body' => $body,
            'position' => $position,
        ]);

        foreach ($answers as $answer) {
            Answer::create([
                'question_id' => $question->id,
                'body' => $answer['body'],
                'is_correct' => $answer['is_correct'],
            ]);
        }
    }
}
