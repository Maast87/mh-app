<script setup>
    import {Link} from "@inertiajs/vue3";
    import {useTheme} from "@/Utilities/composables/useTheme";

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
                                <a href="https://mentalhygiene.me/veelgestelde-vragen/" target="_blank" class="link-underline-green">Veelgestelde vragen</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
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
                                        width="20"
                                        height="20"
                                        id="uuid-45433d1f-8e1a-42d5-9292-58b473add589"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <line x1="18" y1="64" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                        <line x1="75.82" y1="98.18" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                        <line x1="75.82" y1="29.82" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
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
                                        width="20"
                                        height="20"
                                        id="uuid-45433d1f-8e1a-42d5-9292-58b473add589"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <line x1="18" y1="64" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                        <line x1="75.82" y1="98.18" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                        <line x1="75.82" y1="29.82" x2="110" y2="64" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
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
                                <a href="https://mentalhygiene.me/over-mental-hygiene-onze-visie/" target="_blank" class="link-underline-green">Onze visie</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <a href="https://mentalhygiene.me/over-mental-hygiene-onze-visie/#roadmap" target="_blank" class="link-underline-green">Hier werken we aan</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex flex-row items-center gap-x-1.5 group">
                                <a href="https://mentalhygiene.me/over-mental-hygiene-de-oprichters/" target="_blank" class="link-underline-green">De oprichters</a>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
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
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
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
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
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
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
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
                        width="20"
                        height="20"
                        fill="var(--mh-blue-700-gray-100)"
                        data-name="Content"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 128 128"
                    >
                        <path
                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                            stroke="var(--mh-gray-100-blue-900)"
                            stroke-width="1px"
                        />
                        <path
                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                            stroke="var(--mh-gray-100-blue-900)"
                            stroke-width="1px"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>
