<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { index } from '@/actions/App/Http/Controllers/QuizController';
import { show } from '@/actions/App/Http/Controllers/QuizController';

interface Answer {
    id: number;
    body: string;
    is_correct: boolean;
}

interface Question {
    id: number;
    body: string;
    position: number;
    answers: Answer[];
}

interface Quiz {
    id: number;
    title: string;
    description: string | null;
    questions: Question[];
}

const props = defineProps<{
    quiz: Quiz;
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Quizzes',
                href: index.url(),
            },
            {
                title: 'Quiz',
                href: '#',
            },
        ],
    },
});
</script>

<template>
    <Head :title="quiz.title" />

    <div class="flex flex-col gap-6 p-4">
        <div>
            <h1 class="text-2xl font-bold">{{ quiz.title }}</h1>
            <p v-if="quiz.description" class="text-muted-foreground mt-1">
                {{ quiz.description }}
            </p>
        </div>

        <div v-if="quiz.questions.length === 0" class="text-muted-foreground py-12 text-center">
            Dieses Quiz hat noch keine Fragen.
        </div>

        <div class="flex flex-col gap-4">
            <Card v-for="(question, qIndex) in quiz.questions" :key="question.id">
                <CardHeader>
                    <CardTitle class="text-lg">
                        Frage {{ qIndex + 1 }}: {{ question.body }}
                    </CardTitle>
                </CardHeader>
                <CardContent>
                    <ul class="flex flex-col gap-2">
                        <li
                            v-for="answer in question.answers"
                            :key="answer.id"
                            class="rounded-lg border px-4 py-3 text-sm"
                        >
                            {{ answer.body }}
                        </li>
                    </ul>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
