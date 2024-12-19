<script setup>
    import {ref, computed, onMounted, watch} from "vue";
    import { useCheckQuestionsStore } from "@/stores/checkQuestions.js";

    const props = defineProps({
        store: String,
        lowThreshold: {
            max: {
                type: Number,
                required: true,
            },
        },
        midThreshold: {
            min: {
                type: Number,
                required: true,
            },
            max: {
                type: Number,
                required: true,
            },
        },
        highThreshold: {
            min: {
                type: Number,
                required: true,
            }
        },
    });

    const currentQuestionStore = useCheckQuestionsStore();
    const questions = currentQuestionStore[props.store];

    const score = ref(0);
    const currentQuestionId = ref(1);
    const selectedAnswer = ref(null);
    const quizFinished = ref(false);

    const maxScore = computed(() => {
        return questions.reduce((total, question) => {
            const maxChoiceValue = Math.max(...question.choices.map(choice => choice.value));
            return total + maxChoiceValue;
        }, 0);
    });

    const lowThreshold = {
        min: 0,
        max: props.lowThreshold.max,
    };
    const midThreshold = {
        min: props.midThreshold.min,
        max: props.midThreshold.max,
    };
    const highThreshold = {
        min: props.highThreshold.min,
        max: maxScore.value,
    };

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

    const percentageScore = computed(() => {
        if (maxScore.value === 0) return 0; // Prevent division by zero
        return (score.value / maxScore.value) * 100;
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
            return 'low';
        }
        if (score.value >= midThreshold.min && score.value <= midThreshold.max) {
            return 'mid';
        }
        if (score.value >= highThreshold.min) {
            return 'high';
        }
    });

    const animatedWidth = ref("0%");

    watch(quizFinished, (isFinished) => {
        if (isFinished) {
            // Trigger animation once quizFinished becomes true
            setTimeout(() => {
                animatedWidth.value = `${percentageScore.value}%`;
            }, 100);
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
        <div id="result-bar" class="bg-blue-200 p-1 rounded-full w-full h-5 mt-4">
            <div
                class="bg-blue-700 rounded-full h-full progress"
                :style="{ width: animatedWidth }"
            />
        </div>

        <p class="text-xl font-bold">Quiz Finished!</p>
        <p class="mt-4">Your final score is: {{ score }}</p>

        <!-- Result message blocks -->
        <div v-if="result === 'low'" class="result-message">
            <p class="text-lg font-semibold text-green-600">Jouw resultaat</p>
            <div class="mt-2">
                <slot name="message-low-threshold"></slot>
            </div>
        </div>

        <div v-else-if="result === 'mid'" class="result-message">
            <p class="text-lg font-semibold text-blue-600">Jouw resultaat</p>
            <div class="mt-2">
                <slot name="message-mid-threshold" />
            </div>
        </div>

        <div v-else-if="result === 'high'" class="result-message">
            <p class="text-lg font-semibold text-purple-600">Jouw resultaat</p>
            <div class="mt-2">
                <slot name="message-high-threshold" />
            </div>
        </div>
    </div>
</template>

<style scoped>
    #result-bar .progress {
        transition: width 1.5s ease-in-out;
        width: 0;
    }
</style>
