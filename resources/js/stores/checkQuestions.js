import { defineStore } from 'pinia';
export const useCheckQuestionsStore = defineStore('checkQuestions', {
    state: () => ({
        dummyCheckQuestions: [
            {
                id: 1,
                question: "Which language?",
                description: "Pick a language",
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
                description: "Pick a limit",
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
                description: "Pick a stand",
                choices: [
                    { text: "Music Player", value: 20, next: 4 },
                    { text: "Multi Pass", value: 30, next: 4 },
                    { text: "Moving Picture", value: 50, next: 4 }
                ],
            },
            {
                id: 4,
                question: "What is the age?",
                description: "Pick an age",
                choices: [
                    { text: "20", value: 10, next: 5 },
                    { text: "900", value: 15, next: "end" },
                    { text: "1400", value: 25, next: 5 }
                ],
            },
            {
                id: 5,
                question: "What is the recipe?",
                description: "Pick a recipe",
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
                description: "Pick a value",
                choices: [
                    { text: "A little", value: 5, next: 2 },
                    { text: "A lot", value: 5, next: 2 },
                    { text: "Huge amounts", value: 10, next: 2 }
                ],
            },
            {
                id: 2,
                question: "Is there a limit?",
                description: "Pick a limit",
                choices: [
                    { text: "Yes", value: 10, next: "end" },
                    { text: "No", value: 10, next: "end" }
                ],
            }
        ],
    }),
});
