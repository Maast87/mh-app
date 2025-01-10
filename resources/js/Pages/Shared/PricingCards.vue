<script setup>
    import {ref} from "vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";

    const props = defineProps({
        pricing: Object
    });

    const ButtonOneClicked = ref(false);
    const ButtonTwoClicked = ref(false);
    const DisableButtonOne = ref(false);
    const DisableButtonTwo = ref(false);
    const handleClickButtonOne = () => {
        ButtonOneClicked.value = true;
        ButtonTwoClicked.value = false;
        DisableButtonOne.value = false;
        DisableButtonTwo.value = true;
    };
    const handleClickButtonTwo = () => {
        ButtonOneClicked.value = false;
        ButtonTwoClicked.value = true;
        DisableButtonOne.value = true;
        DisableButtonTwo.value = false;
    };

</script>


<template>
    <GradientElement
        class="flex gap-x-4 justify-center"
    >
        <GradientWhiteElement
            class="flex flex-col h-fit text-blue_700_gray_100 !gap-y-0 !p-0 w-1/2"
            :class="{'pointer-events-none opacity-50': $page.props.auth.user?.subscribed}"
        >
            <div
                v-if="$page.props.auth.user && ! $page.props.auth.user?.subscribed"
                class="flex justify-center"

            >
                <p class="bg-blue-700 rounded-br-xl rounded-bl-xl text-gray-100 py-1 w-10/12 items-center text-center font-semibold">
                    Huidig lidmaatschap
                </p>
            </div>
            <div class="flex flex-col gap-y-3 p-3 pb-4">
                <p class="text-header_s">Starter account</p>
                <p class="text-header_m leading-4">€0,-<span class="text-base"> voor altijd</span></p>
                <p class="text-base font-medium">Je hebt:</p>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="var(--mh-green-100)"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        class="size-5 ml-2"
                    >
                        <path
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <p class="text-base">Toegang tot de zelfchecks</p>
                </div>
                <p class="text-base font-medium pt-2 border border-0 border-t border-blue_700_gray_100">Aanvullend op het platform te bestellen</p>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="var(--mh-blue-100)"
                        class="size-5 ml-2"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <p class="text-base">Premium lidmaatschap voor toegang tot de me-learning (€19,99 per maand)</p>
                </div>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="var(--mh-blue-100)"
                        class="size-5 ml-2"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <p class="text-base">1-op-1 coaching voor als je vastloopt (€74,99 per 60 minuten)</p>
                </div>
            </div>
            <div
                v-if="! $page.props.auth.user"
                class="p-3"
            >
                <ButtonOne href="/registreren" title="Maak gratis een account" :disableAfterClick="true" />
            </div>
        </GradientWhiteElement>
        <GradientWhiteElement id="price-monthly" class="flex flex-col h-fit text-blue_700_gray_100 !gap-y-0 !p-0 w-1/2">
            <div
                v-if="$page.props.auth.user && $page.props.auth.user?.subscribed_to_monthly"
                class="flex justify-center"
            >
                <p class="bg-blue-700 rounded-br-xl rounded-bl-xl text-gray-100 py-1 w-10/12 items-center text-center font-semibold">
                    Huidig lidmaatschap
                </p>
            </div>
            <div class="flex flex-col gap-y-3 p-3 pb-4" >
                <p class="text-header_s">Premium lidmaatschap<span class="text-lg" v-if="! $page.props.auth.user">*</span></p>
                <p class="text-header_m leading-4">€19,99<span class="text-base" v-if="$page.props.auth.user">/mnd*</span><span class="text-base" v-if="! $page.props.auth.user">/mnd**</span></p>
                <p class="text-base font-medium">Je hebt:</p>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="var(--mh-green-100)"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        class="size-5 ml-2"
                    >
                        <path
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <p class="text-base">Toegang tot de zelfchecks</p>
                </div>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="var(--mh-green-100)"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        class="size-5 ml-2"
                    >
                        <path
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <p class="text-base">Toegang tot de Me-learning</p>
                </div>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="var(--mh-green-100)"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        class="size-5 ml-2"
                    >
                        <path
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <p class="text-base">Toegang tot relevante supportgroepen</p>
                </div>
                <p class="text-base font-medium pt-2 border border-0 border-t border-blue_700_gray_100">Aanvullend op het platform te bestellen</p>
                <div class="flex items-center gap-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="var(--mh-blue-100)"
                        class="size-5 ml-2"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <p class="text-base">1-op-1 coaching voor als je vastloopt (€74,99 per 60 minuten)</p>
                </div>
            <div>
                <div v-if="$page.props.auth.user">
                    <a
                        v-if="! $page.props.auth.user?.subscribed_to_monthly"
                        :href="`/checkout/${props.pricing.monthly}`"
                        class="mt-4"
                        :class="{'pointer-events-none': ButtonOneClicked, 'pointer-events-none': DisableButtonOne}"
                    >
                        <button
                            class="button-one w-full"
                            :class="{'button-one-loading spinner': ButtonOneClicked, 'button-one-disabled': DisableButtonOne}"
                            @click="handleClickButtonOne">
                            Naar afrekenen
                        </button>
                    </a>
                    <div
                        v-if="$page.props.auth.user?.subscribed"
                        class="grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-1 grid-rows-2 w-full mt-2 gap-x-3"
                    >
                        <a
                            :href="`/billing-portal`"
                            class=""
                            :class="{'pointer-events-none': ButtonOneClicked || ButtonTwoClicked, 'pointer-events-none': DisableButtonOne || DisableButtonTwo}"
                        >
                            <button
                                class="button-one w-full"
                                :class="{'button-one-loading spinner': ButtonOneClicked, 'button-one-disabled': DisableButtonOne || DisableButtonTwo}"
                                @click="handleClickButtonOne">
                                Wijzig je betaalmethode
                            </button>
                        </a>
                        <a
                            :href="`/billing-portal`"
                            class=""
                            :class="{'pointer-events-none': ButtonOneClicked || ButtonTwoClicked, 'pointer-events-none': DisableButtonOne || DisableButtonTwo}"
                        >
                            <button
                                class="button-one w-full"
                                :class="{'button-one-loading spinner': ButtonTwoClicked, 'button-one-disabled': DisableButtonOne || DisableButtonTwo }"
                                @click="handleClickButtonTwo">
                                Lidmaatschap opzeggen
                            </button>
                        </a>

                    </div>
                    <p v-if="! $page.props.auth.user.subscribed" class="text-base italic text-center mt-2">* lidmaatschap is opzegbaar wanneer jij wil</p>
                    <p v-if="$page.props.auth.user.subscribed" class="text-base italic text-center mt-2">* lidmaatschap is opzegbaar wanneer jij wil. Wanneer je opzegt, gebeurt er ... NOG INVULLEN</p>
                </div>
                <div
                    v-if="! $page.props.auth.user"
                    class="flex flex-col gap-y-1 pt-2 border border-0 border-t border-blue_700_gray_100"
                >
                    <p class="text-base italic">* om dit lidmaatschap af te sluiten heb je een Starter account nodig.</p>
                    <p class="text-base italic">** je kunt starten en stoppen met het Premium lidmaatschap wanneer jij wil.</p>
                </div>
            </div>
            </div>
        </GradientWhiteElement>
    </GradientElement>
</template>
