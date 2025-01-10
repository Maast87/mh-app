import { defineStore } from 'pinia';
export const useCheckQuestionsStore = defineStore('checkQuestions', {
    state: () => ({
        dummyCheckQuestions: [
            {
                id: 1,
                question: "Welke taal?",
                description: "Kies een taal",
                choices: [
                    { text: "Frans", value: 5, next: 3 },
                    { text: "Engels", value: 5, next: 3 },
                    { text: "Duits", value: 10, next: 3 },
                    { text: "Spaans", value: 5, next: 3 },
                    { text: "Grieks", value: 85, next: 2 }
                ],
            },
            {
                id: 2,
                question: "Wat is de limiet?",
                description: "Kies een limiet",
                choices: [
                    { text: "100", value: 10, next: 3 },
                    { text: "200", value: 5, next: 3 },
                    { text: "300", value: 5, next: 3 },
                    { text: "400", value: 10, next: 3 }
                ],
            },
            {
                id: 3,
                question: "Waar staat MP in MP3 voor?",
                description: "Kies een antwoord",
                choices: [
                    { text: "Music Player", value: 20, next: 4 },
                    { text: "Multi Pass", value: 30, next: 4 },
                    { text: "Moving Picture", value: 50, next: 4 }
                ],
            },
            {
                id: 4,
                question: "Wat is de leeftijd?",
                description: "Kies een leeftijd",
                choices: [
                    { text: "20", value: 10, next: 5 },
                    { text: "900", value: 15, next: "end" },
                    { text: "1400", value: 25, next: 5 }
                ],
            },
            {
                id: 5,
                question: "Wat is de recept?",
                description: "Kies een recept",
                choices: [
                    { text: "Trifle", value: 5, next: "end" },
                    { text: "Bonen", value: 55, next: "end" },
                    { text: "Hotdog", value: 50, next: "end" }
                ],
            }
        ],
        testCheckQuestions: [
            {
                id: 1,
                question: "Hoeveel",
                description: "Kies een waarde",
                choices: [
                    { text: "Een beetje", value: 5, next: 2 },
                    { text: "Een lot", value: 5, next: 2 },
                    { text: "Grote hoeveelheden", value: 10, next: 2 }
                ],
            },
            {
                id: 2,
                question: "Is er een limiet?",
                description: "Kies een optie",
                choices: [
                    { text: "Ja", value: 10, next: "end" },
                    { text: "Nee", value: 10, next: "end" }
                ],
            }
        ],
    }),
});
