<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import {provide, ref, computed} from "vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import PasswordInput from '@/Components/PasswordInput.vue';

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "log in" }
    ];
    provide('breadcrumbs', breadcrumbs);

    defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const isFormValid = computed(() => {
        return form.email !== '' &&
            form.password !== ''
    });

    const loginSuccessful = ref(false);

    const submit = () => {
        setTimeout(() => {
            form.post(route('login'), {
                onSuccess: () => {
                    loginSuccessful.value = true;
                },
                onError: () => {
                    loginSuccessful.value = false;
                    form.processing = false;
                }
            });
        }, 25);
    };
</script>

<template>
    <Layout>
        <Head title="Log in" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center"><span class="gradient-text">Log in</span> bij Mental Hygiene</h1>
                <p class="text-base text-blue_700_gray_100">Alles over mentale ontwikkeling op één plek</p>
                <p class="text-base text-blue_700_gray_100">Nog geen account? Registreer je <Link href="/registreren" class="link-underline-green font-semibold">hier</Link>.</p>
            </div>

            <GradientElement class="flex flex-col gap-y-3 lg:w-1/2">
                <GradientWhiteElement class="flex flex-col gap-y-3">
                    <div 
                        v-if="status"
                        class="flex items-center mb-4 text-sm font-medium border border-blue_700_gray_100 rounded-lg p-1.5 gap-x-1.5"
                    >
                        <div class="w-10 h-10">
                            <svg id="uuid-b8f6a5c4-e2ad-4025-8699-8e391ad2ceec" data-name="Content" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                <circle cx="61.5" cy="62.5" r="45.5" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-miterlimit: 10; stroke-width: 4.5px;"/>
                                <g>
                                    <line x1="56.62" y1="84.65" x2="40.98" y2="65.28" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                    <line x1="86.57" y1="43.08" x2="56.62" y2="84.65" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                </g>
                            </svg>
                        </div>
                        <p class="text-blue_700_gray_100">
                            {{ status }}
                        </p>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="E-mailadres" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Wachtwoord" />
                            <PasswordInput
                                v-model="form.password"
                                id="password"
                                name="password"
                                placeholder="Wachtwoord"
                                required
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-base text-blue_700_gray_100"
                                    >Onthoud mij</span>
                            </label>
                        </div>

                        <div class="mt-6 flex flex-col items-center justify-center gap-y-2">
                            <ButtonOne 
                                title="Log in" 
                                :allowSpinner="isFormValid && loginSuccessful"
                                :disableAfterClick="isFormValid && loginSuccessful"
                                :class="{ 'pointer-events-none opacity-50': !isFormValid }"
                            />

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="rounded-md text-base font-medium link-underline-green focus:ring-2 focus:ring-blue-700 focus:ring-offset-2"
                            >
                                Wachtwoord vergeten?
                            </Link>
                        </div>
                    </form>
                </GradientWhiteElement>
            </GradientElement>
        </div>
    </Layout>
</template>
