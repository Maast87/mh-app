<script setup>
    import {ref, computed, onMounted} from "vue";
    import {useCheckQuestionsStore} from "@/stores/checkQuestions.js";

    const props = defineProps({
        store: String,
    })
    const currentQuestionStore = useCheckQuestionsStore();
    const questions = currentQuestionStore[props.store];

    const score = ref(0);
    const currentQuestionId = ref(1);
    const selectedAnswer = ref(null);
    const quizFinished = ref(false);

    const lowThreshold = { min: 0, max: 99 };
    const midThreshold = { min: 100, max: 149 };
    const highThreshold = { min: 150, max: Infinity };

    const loadProgress = () => {
        const savedScore = localStorage.getItem("score");
        const savedQuestionId = localStorage.getItem("currentQuestionId");

        if (savedScore && savedQuestionId) {
            score.value = parseInt(savedScore, 10);
            currentQuestionId.value = parseInt(savedQuestionId, 10);
        }
    };

    // Get the current question object based on currentQuestionId
    const currentQuestion = computed(() => {
        return questions.find(q => q.id === currentQuestionId.value);
    });

    // Compute the progress
    const progress = computed(() => {
        const totalQuestions = questions.length;
        const currentQuestionIndex = questions.findIndex(q => q.id === currentQuestionId.value);
        return (currentQuestionIndex / totalQuestions) * 100;
    });

    const loadQuestion = () => {
        const currentQuestion = questions.find(q => q.id === currentQuestionId.value);
        if (currentQuestion) {
            selectedAnswer.value = null; // Reset the selected answer for each new question
        }
    };

    const onOptionClicked = (choice) => {
        selectedAnswer.value = choice; // Set the selected answer
    };

    const onSaveAndProceed = () => {
        if (selectedAnswer.value) {
            score.value += selectedAnswer.value.value; // Increment score by the selected answer's value

            const nextQuestion = selectedAnswer.value.next;

            if (nextQuestion === "end") {
                quizFinished.value = true;
            } else {
                currentQuestionId.value = nextQuestion;
            }

            if (quizFinished.value === true) {
                localStorage.removeItem("score");
                localStorage.removeItem("currentQuestionId");
            } else {
                saveProgress();
            }

            loadQuestion();
        }
    };

    // Save progress to localStorage
    const saveProgress = () => {
        localStorage.setItem("score", score.value.toString());
        localStorage.setItem("currentQuestionId", currentQuestionId.value.toString());
    };

    // Computed property to determine the result based on score
    const result = computed(() => {
        if (score.value >= lowThreshold.min && score.value <= lowThreshold.max) {
            return lowThreshold;
        }
        if (score.value >= midThreshold.min && score.value <= midThreshold.max) {
            return midThreshold;
        }
        if (score.value >= highThreshold.min && score.value <= highThreshold.max) {
            return highThreshold;
        }
    });

    onMounted(() => {
        loadProgress();
        loadQuestion();
    });
</script>

<template>
    <div class="flex flex-col" v-if="!quizFinished && currentQuestion">
        <div class="mb-6">
            {{ currentQuestion.question }}
        </div>

        <div v-for="(choice, index) in currentQuestion.choices" :key="index" class="flex mb-3">
            <div
                class="flex cursor-pointer"
                :class="{'bg-blue-300': selectedAnswer && selectedAnswer.text === choice.text}"
                @click="onOptionClicked(choice)"
            >
                <div>
                    {{ choice.text }}
                </div>
            </div>
        </div>

        <div>
            Score: {{ score }}
        </div>

        <div>
            {{ currentQuestionId }} / {{ questions.length }}
        </div>

        <div id="progress-bar" class="bg-blue-200 p-1 rounded-full w-full h-5 mt-4">
            <div
                class="bg-blue-700 rounded-full h-full"
                :style="`width: ${progress}%`"
            />
        </div>

        <!-- Save and Proceed button -->
        <div class="mt-4">
            <button
                :disabled="!selectedAnswer"
                @click="onSaveAndProceed"
                class="bg-blue-500 text-white py-2 px-4 rounded disabled:opacity-50"
            >
                Save and Proceed
            </button>
        </div>
    </div>

    <!-- Quiz completion and results, visible when quiz is finished -->
    <div v-if="quizFinished" class="text-center">
        <p class="text-xl font-bold">Quiz Finished!</p>
        <p class="mt-4">Your final score is: {{ score }}</p>

        <!-- Result message blocks -->
        <div v-if="result === lowThreshold" class="result-message">
            <p class="text-lg font-semibold text-green-600">You did great!</p>
            <p class="mt-2">Keep practicing, and you'll improve even more!</p>
        </div>

        <div v-else-if="result === midThreshold" class="result-message">
            <p class="text-lg font-semibold text-blue-600">You did amazing!</p>
            <p class="mt-2">You're doing very well. Keep up the fantastic work!</p>
        </div>

        <div v-else class="result-message">
            <p class="text-lg font-semibold text-purple-600">You did incredible!</p>
            <p class="mt-2">Wow, you're a master at this! Great job!</p>
        </div>
    </div>
</template>
