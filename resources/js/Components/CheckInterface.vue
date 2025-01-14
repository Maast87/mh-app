<script setup>
    import { ref, computed, onMounted, watch } from "vue";
    import { useCheckQuestionsStore } from "@/stores/checkQuestions.js";
    import ButtonOne from "./Buttons/ButtonOne.vue";
    import { router } from '@inertiajs/vue3';

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
        checkId: {
            type: Number,
            required: true
        }
    });

    const currentQuestionStore = useCheckQuestionsStore();
    const questions = currentQuestionStore[props.store];

    const score = ref(0);
    const animatedScore = ref(0); // For the animated score count-up
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

    watch(quizFinished, (isFinished) => {
        if (isFinished) {
            const duration = 1500;
            const startTime = performance.now();

            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1); // Normalized progress (0 to 1)
                const easing = progress * (2 - progress); // Ease-out effect

                animatedScore.value = Math.floor(score.value * easing);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };

            requestAnimationFrame(animate);
            saveScore();
        }
    });

    const saveScore = () => {
        router.post('/me-learning', {
            score: score.value,
            check_id: props.checkId
        });
    };

    onMounted(() => {
        loadProgress();
        loadQuestion();
    });
</script>


<template>
    <div
        v-if="!quizFinished && currentQuestion"
        class="flex flex-col border border-gray-300 rounded-xl w-full"
    >
        <div class="flex flex-col text-base bg-gray-300 rounded-xl p-2 text-center">
            <p class="font-semibold">
                {{ currentQuestion.question }}
            </p>
            <p>
                {{ currentQuestion.description }}
            </p>
        </div>

        <div class="flex flex-col p-4 w-full bg-gray_100_blue_900 rounded-xl">
            <div class="text-center">
                Vraag {{ currentQuestionId }} van {{ questions.length }}
            </div>

            <div id="progress-bar" class="bg-gray-300 rounded-xl w-full h-6 mt-3 p-0.5">
                <div
                    class="bg-blue_700_blue_900 rounded-full h-full"
                    :style="`width: ${progress}%`"
                />
            </div>

            <div class="flex flex-col gap-y-6 p-2 mt-4">
                <div
                    v-for="(choice, index) in currentQuestion.choices"
                    :key="index"
                    class="flex"
                >
                    <div
                        class="group flex button-five cursor-pointer w-full"
                        :class="{'button-quinary-current': selectedAnswer && selectedAnswer.text === choice.text}"
                        @click="onOptionClicked(choice)"
                    >
                        <div
                            class="font-semibold group-hover:gradient-text"
                            :class="{'gradient-text': selectedAnswer && selectedAnswer.text === choice.text}"
                        >
                            {{ choice.text }}
                        </div>
                    </div>
                </div>
            </div>
                <div class="mt-4">
                    <button
                        :disabled="!selectedAnswer"
                        @click="onSaveAndProceed"
                        class="button-one disabled:opacity-50 disabled:pointer-events-none disabled:cursor-not-allowed"
                    >
                        Opslaan en doorgaan
                    </button>
                </div>
        </div>
    </div>

    <div
        v-if="quizFinished"
        class="flex flex-col border border-gray-300 rounded-xl w-full"
    >
        <div class="flex flex-col text-base bg-gray-300 rounded-xl p-2 text-center">
            <p class="text-xl font-bold">Uitslag van de check</p>
        </div>

        <div class="flex flex-col p-4 w-full bg-gray_100_blue_900 rounded-xl">
            <p class="text-center text-blue_700_gray_100">Jouw puntentotaal is:<br><span class="text-header_xl text-green-100">{{ animatedScore }}</span></p>

            <p class="text-header_s text-blue_700_gray_100">Toelichting</p>
            <!-- Result message blocks -->
            <div v-if="result === 'low'" class="result-message text-blue_700_gray_100">
                <div>
                    <slot name="message-low-threshold"></slot>
                </div>
            </div>

            <div v-else-if="result === 'mid'" class="result-message text-blue_700_gray_100">
                <div>
                    <slot name="message-mid-threshold" />
                </div>
            </div>

            <div v-else-if="result === 'high'" class="result-message text-blue_700_gray_100">
                <div>
                    <slot name="message-high-threshold" />
                </div>
            </div>
        </div>
    </div>
</template>