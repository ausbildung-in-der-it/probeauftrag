<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    public function index(): Response
    {
        $quizzes = Quiz::withCount('questions')->latest()->get();

        return Inertia::render('Quizzes/Index', [
            'quizzes' => $quizzes,
        ]);
    }

    public function show(Quiz $quiz): Response
    {
        $quiz->load('questions.answers');

        return Inertia::render('Quizzes/Show', [
            'quiz' => $quiz,
        ]);
    }
}
