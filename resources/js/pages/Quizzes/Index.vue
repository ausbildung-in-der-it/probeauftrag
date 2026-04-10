<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { index } from '@/actions/App/Http/Controllers/QuizController';
import { show } from '@/actions/App/Http/Controllers/QuizController';

interface Quiz {
    id: number;
    title: string;
    description: string | null;
    is_published: boolean;
    questions_count: number;
    created_at: string;
}

const props = defineProps<{
    quizzes: Quiz[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Quizzes',
                href: index.url(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Quizzes" />

    <div class="flex flex-col gap-6 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Quizzes</h1>
        </div>

        <div v-if="quizzes.length === 0" class="text-muted-foreground py-12 text-center">
            Noch keine Quizze vorhanden.
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <Link
                v-for="quiz in quizzes"
                :key="quiz.id"
                :href="show.url(quiz.id)"
                class="transition-shadow hover:shadow-md"
            >
                <Card>
                    <CardHeader>
                        <div class="flex items-start justify-between">
                            <CardTitle>{{ quiz.title }}</CardTitle>
                            <Badge :variant="quiz.is_published ? 'default' : 'secondary'">
                                {{ quiz.is_published ? 'Veröffentlicht' : 'Entwurf' }}
                            </Badge>
                        </div>
                        <CardDescription v-if="quiz.description">
                            {{ quiz.description }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <p class="text-muted-foreground text-sm">
                            {{ quiz.questions_count }} {{ quiz.questions_count === 1 ? 'Frage' : 'Fragen' }}
                        </p>
                    </CardContent>
                </Card>
            </Link>
        </div>
    </div>
</template>
