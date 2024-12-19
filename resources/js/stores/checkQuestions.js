import { defineStore } from 'pinia';
export const useCheckQuestionsStore = defineStore('checkQuestions', {
    state: () => ({
        dummyCheckQuestions: [
            {
                id: 1,
                question: "Which language?",
                choices: [
                    { text: "Java", value: 5, next: 3 },
                    { text: "Python", value: 5, next: 3 },
                    { text: "C", value: 10, next: 3 },
                    { text: "HTML", value: 5, next: 3 },
                    { text: "Greek", value: 85, next: 2 }
                ],
            },
            {
                id: 2,
                question: "What is the limit?",
                choices: [
                    { text: "100", value: 10, next: 3 },
                    { text: "200", value: 5, next: 3 },
                    { text: "300", value: 5, next: 3 },
                    { text: "400", value: 10, next: 3 }
                ],
            },
            {
                id: 3,
                question: "What does it stand for?",
                choices: [
                    { text: "Music Player", value: 20, next: 4 },
                    { text: "Multi Pass", value: 30, next: 4 },
                    { text: "Moving Picture", value: 50, next: 4 }
                ],
            },
            {
                id: 4,
                question: "What is the age?",
                choices: [
                    { text: "20", value: 10, next: 5 },
                    { text: "900", value: 15, next: "end" },
                    { text: "1400", value: 25, next: 5 }
                ],
            },
            {
                id: 5,
                question: "What is the recipe?",
                choices: [
                    { text: "Trifle", value: 5, next: "end" },
                    { text: "Beans", value: 55, next: "end" },
                    { text: "Hotdog", value: 50, next: "end" }
                ],
            }
        ],
        testCheckQuestions: [
            {
                id: 1,
                question: "How much",
                choices: [
                    { text: "A little", value: 5, next: 2 },
                    { text: "A lot", value: 5, next: 2 },
                    { text: "Huge amounts", value: 10, next: 2 }
                ],
            },
            {
                id: 2,
                question: "Is there a limit?",
                choices: [
                    { text: "Yes", value: 10, next: "end" },
                    { text: "No", value: 10, next: "end" }
                ],
            }
        ],
    }),
});
