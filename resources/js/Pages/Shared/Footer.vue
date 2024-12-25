<script setup>
    import {Link} from "@inertiajs/vue3";
    import {useTheme} from "../../../composables/useTheme";

    const {dark} = useTheme();

</script>

<template>
    <div id="footer" class="flex flex-col mx-auto max-w-7xl p-3 bg-gray_100_blue_900 border border-gray-400 rounded-xl gap-y-3 mt-10">
        <div class="flex flex-row gap-x-1">
            <div>
                <Link href="/home" class="outline outline-red-500 inline-block">
                    <span class="sr-only">Mental Hygiene logo</span>
                    <img
                        v-if="!dark"
                        id="logo-light-mode"
                        src="../../../images/mental-hygiene-beta-logo-light-vertical.svg"
                        alt="Mental Hygiene Logo Light Mode"
                        class="outline outline-blue-500 w-[calc(20%+6rem)] h-auto m-0 p-0"
                    />
                    <img
                        v-else
                        id="logo-dark-mode"
                        src="../../../images/mental-hygiene-beta-logo-dark-vertical.svg"
                        alt="Mental Hygiene Logo Dark Mode"
                        class="w-[calc(20%+6rem)] h-auto m-0 p-0"
                    />
                </Link>
            </div>
            <div class="flex flex-row items-start gap-x-20">
                <div>
                    <p class="font-semibold text-blue_700_gray_100">
                        Handige info
                    </p>
                    <ul>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/ondersteuning/veelgestelde-vragen" class="link-underline-green">Veelgestelde vragen</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/life-events" class="link-underline-green">Life-events</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/voorwaarden" class="link-underline-green">Voorwaarden</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/privacybeleid" class="link-underline-green">Privacybeleid</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="font-semibold text-blue_700_gray_100">
                        Meer over ons
                    </p>
                    <ul>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/visie" class="link-underline-green">Onze visie</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/hier-werken-we-aan" class="link-underline-green">Hier werken we aan</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <Link href="/de-oprichters" class="link-underline-green">De oprichters</Link>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="font-semibold text-blue_700_gray_100">
                        Voor de echte fans
                    </p>
                    <ul>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <a href="https://www.instagram.com/mentalhygiene.me/" target="_blank" class="link-underline-green">Instagram</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <a href="https://www.youtube.com/channel/UCnp7gnFzRFwrxkrxmmncpmg" target="_blank" class="link-underline-green">YouTube</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <a href="#" target="_blank" class="link-underline-green">LinkedIn (toevoegen)</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke="var(--mh-blue-700-gray-100)"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-blue-700 pt-3 w-full">
            <div class="group inline-flex flex flex-row items-center gap-x-1">
                <p class="text-blue_700_gray_100">
                    &copy; 2024 - Mental Hygiene. Alle content op deze website is onder licentie van <a target="_blank" href="https://crealize.nl" class="link-underline-green">Crealize Coaching</a>
                </p>
                <div>
                    <svg
                        class="group-hover:translate-x-[3px] mh-transition"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke="var(--mh-blue-700-gray-100)"
                            stroke-width="1.5"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>
