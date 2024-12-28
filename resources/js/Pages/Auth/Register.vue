<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import {provide} from "vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "registreren" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('registreren'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>

<template>
    <Layout>
        <Head title="Registreren" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center"><span class="gradient-text">Registreren</span> bij<br>Mental Hygiene</h1>
                <p class="text-base text-blue_700_gray_100 text-center">Maak gratis een account aan. Wanneer je dat hebt, <br>kun je ervoor kiezen om een betaald lidmaatschap af te sluiten.</p>
            </div>

            <GradientElement class="flex flex-col gap-y-3">
                <GradientWhiteElement>
                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600"
                    >
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Gebruikersnaam" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Brian1991"
                            />
                            <InputError class="mt-1" :message="form.errors.name" />

                            <p class="text-sm mt-1.5 text-blue_700_gray_100">De gebruikersnaam die je kiest is zichbaar voor andere leden</p>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="E-mailadres" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="username"
                                placeholder="brian@voorbeeld.nl"
                            />
                            <InputError class="mt-1" :message="form.errors.email" />

                            <p class="text-sm mt-1.5 text-blue_700_gray_100">Je e-mailadres is niet zichbaar voor andere leden</p>

                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Wachtwoord" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />

                            <InputError class="mt-1" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Bevestig wachtwoord"
                            />

                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />

                            <InputError
                                class="mt-1" :message="form.errors.password_confirmation"
                            />
                        </div>

                        <div class="mt-6 flex flex-col items-center justify-center gap-y-2">
                            <button
                                class="button-primary w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Maak mijn gratis account aan
                            </button>
                            <Link
                                :href="route('login')"
                                class="rounded-md text-base font-medium link-underline-green focus:ring-2 focus:ring-blue-700 focus:ring-offset-2"
                            >
                                Ik heb al een account en wil inloggen
                            </Link>
                        </div>
                    </form>
                </GradientWhiteElement>

                <GradientWhiteElement>
                    <div class="flex text-base text-blue_700_gray_100 items-center justify-center">
                        Wanneer je je registreert, ga je akkoord met onze&nbsp
                        <div class="flex group items-center">
                            <div>
                                <Link
                                    href="/voorwaarden"
                                    target="_blank"
                                    class="text-blue_700_gray_100 font-medium link-underline-green"
                                >
                                    voorwaarden
                                </Link>
                            </div>
                            <div>
                                <svg
                                    class="group-hover:translate-x-[2px] mh-transition ml-1"
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
                        , en ons&nbsp
                        <div class="flex group items-center">
                            <div>
                                <Link
                                    href="/privacybeleid"
                                    target="_blank"
                                    class="text-blue_700_gray_100 font-medium link-underline-green"
                                >
                                    privacybeleid
                                </Link>
                            </div>
                            <div>
                                <svg
                                    class="group-hover:translate-x-[2px] mh-transition ml-1"
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
                        .
                    </div>
                </GradientWhiteElement>
            </GradientElement>
        </div>
    </Layout>
</template>
