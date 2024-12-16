import { defineStore } from 'pinia';

export const useMenuStore = defineStore('menu', {
    state: () => ({
        profielMenuItems: [
            {
                name: 'Mijn profiel',
                description: 'Alles over @username',
                href: '/mijn-profiel',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke="#0E122C"
                            stroke-width="1.5"
                        />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Al mijn resultaten',
                description: 'Bekijk al jouw resultaten in één keer',
                href: 'al-mijn-resultaten',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    <path
                        d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Instellingen',
                description: 'Stel alles in zoals jij dat wil',
                href: '/instellingen',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    <path
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Lidmaatschap',
                description: 'Informatie over jouw lidmaatschap',
                href: '/lidmaatschap',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Log uit',
                description: 'Log uit van het platform',
                href: '/logout',
                method: 'POST',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
        ],
        resultatenMenuItems: [
            {
                name: 'Mijn doelen',
                description: 'De doelen die je hebt gesteld',
                href: '/mijn-doelen',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Mijn antwoorden',
                description: 'Beschrijving komt hier',
                href: '/mijn-antwoorden',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Mijn statistieken',
                description: 'Beschrijving komt hier',
                href: '/mijn-statistieken',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Mijn achievements',
                description: 'Beschrijving komt hier',
                href: 'mijn-achievements',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
            {
                name: 'Al mijn resultaten',
                description: 'Bekijk al jouw resultaten in één keer',
                href: 'al-mijn-resultaten',
                icon: `
                <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    <path
                        d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="1.5"
                    />
                    </svg>
                </div>
            `,
            },
        ],
        ondersteuningMenuItems: [
            {
                name: 'Mijn supportgroepen',
                description: 'Hier komen de supportgroepen',
                href: '/mijn-supportgroepen',
                icon: `
                    <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                        <svg
                            width="28"
                            height="28"
                            viewBox="0 0 24 24"
                            fill="none"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                            d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke="#0E122C"
                            stroke-width="1.5"
                        />
                        </svg>
                    </div>
                `,
            },
            {
                name: 'Coaching',
                description: '1-op-1 coaching van een expert',
                href: '/coaching',
                icon: `
                    <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                        <svg
                            width="28"
                            height="28"
                            viewBox="0 0 24 24"
                            fill="none"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke="#0E122C"
                            stroke-width="1.5"
                        />
                        </svg>
                    </div>
                `,
            },
            {
                name: 'Veelgestelde vragen',
                description: 'Vraag? Antwoord.',
                href: '/veelgestelde-vragen',
                icon: `
                    <div class="flex items-center justify-center bg-mh_gray_blue rounded-md w-[48px] h-[48px]">
                        <svg
                            width="28"
                            height="28"
                            viewBox="0 0 24 24"
                            fill="none"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke="#0E122C"
                            stroke-width="1.5"
                        />
                        </svg>
                    </div>
                `,
            },
        ],
    }),
    getters: {
        getProfielMenuItems: (state) => state.profielMenuItems,
        getResultatenMenuItems: (state) => state.resultatenMenuItems,
        getOndersteuningMenuItems: (state) => state.ondersteuningMenuItems,
    },
});
