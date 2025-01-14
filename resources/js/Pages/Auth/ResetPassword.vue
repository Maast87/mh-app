<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import { Head, useForm } from '@inertiajs/vue3';
    import {provide, ref, watch, computed} from "vue";
    import PasswordInput from "@/Components/PasswordInput.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "log in", href: "/login" },
        { label: "wachtwoord resetten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        email: {
            type: String,
            required: true,
        },
        token: {
            type: String,
            required: true,
        },
    });

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const passwordValidations = ref({
        minLength: false,
        hasUppercase: false,
        hasNumber: false
    });

    const hasStartedTyping = ref(false);
    const passwordConfirmationError = ref('');
    const passwordCheckTimeout = ref(null);

    const isFormValid = computed(() => {
        return form.email !== '' &&
            form.password !== '' &&
            form.password_confirmation !== '' &&
            passwordValidations.value.minLength &&
            passwordValidations.value.hasUppercase &&
            passwordValidations.value.hasNumber &&
            form.password === form.password_confirmation;
    });

    const resetPasswordSuccessful = ref(false);

    watch(() => form.password_confirmation, (newValue) => {
        if (passwordCheckTimeout.value) clearTimeout(passwordCheckTimeout.value);
        
        if (!newValue) {
            passwordConfirmationError.value = '';
            return;
        }
        
        passwordCheckTimeout.value = setTimeout(() => {
            if (form.password !== newValue) {
                passwordConfirmationError.value = 'De wachtwoorden komen niet overeen.';
            } else {
                passwordConfirmationError.value = '';
            }
        }, 1000);
    });

    watch(() => form.password, () => {
        passwordConfirmationError.value = '';
    });

    watch(() => form.password, (newPassword) => {
        if (newPassword) hasStartedTyping.value = true;
        passwordValidations.value.minLength = newPassword.length >= 10;
        passwordValidations.value.hasUppercase = /[A-Z]/.test(newPassword);
        passwordValidations.value.hasNumber = /\d/.test(newPassword);
    });

    const submit = () => {
        setTimeout(() => {
            form.post(route('password.store'), {
                onSuccess: () => {
                    resetPasswordSuccessful.value = true;
                },
                onError: () => {
                    resetPasswordSuccessful.value = false;
                    form.processing = false;
                },
                onFinish: () => form.reset('password', 'password_confirmation'),
            });
        }, 25);
    };
</script>

<template>
    <Layout>
        <Head title="Reset wachtwoord" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center">Wachtwoord <span class="gradient-text">resetten</span></h1>
                <p class="text-base text-blue_700_gray_100 text-center">Vul je e-mailadres en je nieuwe wachtwoord in, en klik op opslaan.</p>
            </div>

            <div class="gradient-background rounded-2xl p-3 lg:w-1/2">
                <div class="flex flex-col bg-gray_100_blue_900 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">

                    <form @submit.prevent="submit">
                        <div class="flex flex-col gap-y-6">
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

                            <!-- Password field -->
                            <div>
                                <InputLabel for="password" value="Wachtwoord" class="flex"/>
                                <PasswordInput
                                    v-model="form.password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                />
                                <InputError class="mt-1.5" :message="form.errors.password"/>
                                <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                    Wachtwoord checklist:
                                </p>
                                <div>
                                    <ul class="text-sm space-y-1">
                                        <li class="flex items-center gap-x-2">
                                            <div class="w-5 h-5">
                                                <svg v-if="passwordValidations.minLength" id="mental-hygiene-icon-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-green-100); stroke-miterlimit: 10; stroke-width: 4.5px"/>
                                                    <polyline points="34.96 64.43 56.16 85.63 92.33 42.37" style="fill: none; stroke: var(--mh-green-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px"/>
                                                </svg>
                                                <svg v-else="!passwordValidations.minLength" id="mental-hygiene-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-blue-700); stroke-miterlimit: 10; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="40.5" y1="40.5" x2="87.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="87.5" y1="40.5" x2="40.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                </svg>
                                            </div>
                                            <span
                                                :class="{
                                                    'text-green-100': passwordValidations.minLength,
                                                    'text-blue-700 opacity-60': !passwordValidations.minLength
                                                }"
                                            >
                                                Minimale lengte van 10 tekens
                                            </span>
                                        </li>
                                        <li class="flex items-center gap-x-2">
                                            <div class="w-5 h-5">
                                                <svg v-if="passwordValidations.hasUppercase" id="mental-hygiene-icon-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-green-100); stroke-miterlimit: 10; stroke-width: 4.5px"/>
                                                    <polyline points="34.96 64.43 56.16 85.63 92.33 42.37" style="fill: none; stroke: var(--mh-green-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px"/>
                                                </svg>
                                                <svg v-else="!passwordValidations.hasUppercase" id="mental-hygiene-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-blue-700); stroke-miterlimit: 10; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="40.5" y1="40.5" x2="87.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="87.5" y1="40.5" x2="40.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                </svg>
                                            </div>
                                            <span
                                                :class="{
                                                    'text-green-100': passwordValidations.hasUppercase,
                                                    'text-blue-700 opacity-60': !passwordValidations.hasUppercase
                                                }"
                                            >
                                                Ten minste 1 hoofdletter
                                            </span>
                                        </li>
                                        <li class="flex items-center gap-x-2">
                                            <div class="w-5 h-5">
                                                <svg v-if="passwordValidations.hasNumber" id="mental-hygiene-icon-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-green-100); stroke-miterlimit: 10; stroke-width: 4.5px"/>
                                                    <polyline points="34.96 64.43 56.16 85.63 92.33 42.37" style="fill: none; stroke: var(--mh-green-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px"/>
                                                </svg>
                                                <svg v-else="!passwordValidations.hasNumber" id="mental-hygiene-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <path d="M64,10c29.7,0,54,24.3,54,54s-24.3,54-54,54S10,93.7,10,64,34.3,10,64,10Z" style="fill: none; stroke: var(--mh-blue-700); stroke-miterlimit: 10; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="40.5" y1="40.5" x2="87.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                    <line x1="87.5" y1="40.5" x2="40.5" y2="87.5" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px; opacity: 0.6"/>
                                                </svg>
                                            </div>
                                            <span
                                                :class="{
                                                    'text-green-100': passwordValidations.hasNumber,
                                                    'text-blue-700 opacity-60': !passwordValidations.hasNumber
                                                }"
                                            >
                                                Ten minste 1 cijfer
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Password Confirmation field -->
                            <div>
                                <InputLabel for="password_confirmation" value="Bevestig wachtwoord"/>
                                <PasswordInput
                                    v-model="form.password_confirmation"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />
                                <InputError class="mt-1.5" :message="form.errors.password_confirmation"/>
                                <InputError class="mt-2" :message="passwordConfirmationError" />
                            </div>

                            <div class="flex items-center justify-end">
                                <ButtonOne 
                                    title="Wachtwoord opslaan" 
                                    :allowSpinner="isFormValid && resetPasswordSuccessful"
                                    :disableAfterClick="isFormValid && resetPasswordSuccessful"
                                    :class="{ 'pointer-events-none opacity-50': !isFormValid }"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
