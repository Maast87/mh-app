<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { ref, watch, provide, computed } from "vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import { Switch } from '@headlessui/vue'
    import PasswordInput from '@/Components/PasswordInput.vue';
    import axios from 'axios';

    const breadcrumbs = [
            { label: "home", href: "/" },
            { label: "registreren" }
        ];
    provide('breadcrumbs', breadcrumbs);

    const form = useForm({
        name: '',
        tag_name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms_accepted: false,
    });

    const isFormValid = computed(() => {
        return form.name !== '' &&
            form.tag_name !== '' &&
            form.email !== '' &&
            form.password !== '' &&
            form.password_confirmation !== '' &&
            form.terms_accepted === true &&
            !nameExists.value;
    });

    const passwordValidations = ref({
        minLength: false,
        hasUppercase: false,
        hasNumber: false
    });

    watch(() => form.password, (newPassword) => {
        passwordValidations.value.minLength = newPassword.length >= 10;
        passwordValidations.value.hasUppercase = /[A-Z]/.test(newPassword);
        passwordValidations.value.hasNumber = /\d/.test(newPassword);
    });

    const nameExists = ref(false);
    const isCheckingName = ref(false);
    let nameCheckTimeout = null;

    const checkNameExists = async (name) => {
        if (!name) {
            nameExists.value = false;
            return;
        }

        isCheckingName.value = true;
        try {
            const response = await axios.post(route('validate.username'), { name }, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            });
            nameExists.value = response.data.exists;
        } catch (error) {
            nameExists.value = false;
        } finally {
            isCheckingName.value = false;
        }
    };

    const cleanNameInput = (event) => {
        let inputValue = event.target.value;
        inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');
        inputValue = inputValue.replace(/\s+/g, ' ');
        form.name = inputValue;

        // Clear any existing timeout
        if (nameCheckTimeout) {
            clearTimeout(nameCheckTimeout);
        }

        // Set a new timeout to check the name after 1 second of no typing
        nameCheckTimeout = setTimeout(() => {
            checkNameExists(inputValue);
        }, 1000);
    };

    watch(() => form.name, (newValue) => {
        if (newValue) {
            const tagName = '@' + newValue
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^a-z0-9-]/g, '')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            form.tag_name = tagName;
        } else {
            form.tag_name = '';
        }
    });

    const submit = () => {
        if (!form.terms_accepted) {
            form.errors.terms_accepted = "Om een account aan te maken, heb je akkoord te gaan met onze voorwaarden en privacybeleid";
            return;
        }

        setTimeout(() => {
            form.post(route('registreren'), {
                onFinish: () => form.reset('password', 'password_confirmation'),
            });
        }, 450);
    };
</script>

<template>
    <Layout>
        <Head title="Registreren"/>

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-3">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center">
                    <span class="gradient-text">Registreren</span> bij<br>Mental Hygiene
                </h1>
                <p class="text-base text-blue_700_gray_100 text-center">
                    Maak gratis een account aan. Wanneer je dat hebt, <br>
                    kun je ervoor kiezen om een betaald lidmaatschap af te sluiten.
                </p>
            </div>

            <GradientElement class="flex flex-col gap-y-3 lg:w-2/3">
                <GradientWhiteElement>
                    <form @submit.prevent="submit">
                        <div class="flex flex-col gap-y-6">
                            <!-- User fields -->
                            <div>
                                <InputLabel for="name" value="Gebruikersnaam"/>
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Brian1991"
                                    @input="cleanNameInput"
                                    :class="{ 'border-red-500': nameExists }"
                                />
                                <InputError class="mt-2" :message="form.errors.name"/>

                                <div v-if="nameExists" class="flex gap-x-3 mt-2 rounded-lg bg-red-200 p-2 items-center">
                                    <div class="w-10 h-10">
                                        <svg 
                                            id="uuid-5e00ec1d-c691-43cc-a035-8f7535066b85" 
                                            data-name="Content" 
                                            xmlns="http://www.w3.org/2000/svg" 
                                            viewBox="0 0 128 128"
                                        >
                                        <path d="M60.97,21.37L17.23,97.14c-1.35,2.33.34,5.24,3.03,5.24h87.49c2.69,0,4.37-2.91,3.03-5.24L67.03,21.37c-1.35-2.33-4.71-2.33-6.05,0Z" style="fill: none; stroke: var(--mh-gray-100); stroke-miterlimit: 10; stroke-width: 4.5px;"/>
                                            <line x1="64" y1="46.5" x2="64" y2="78.5" style="fill: none; stroke: var(--mh-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                            <circle cx="64" cy="86" r=".5" style="fill: none; stroke: var(--mh-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-100">Iemand anders heeft deze gebruikersnaam al gekozen. Kies een andere.</p>
                                    </div>
                                </div>
                                <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                    Je gebruikersnaam komt op je profiel te staan, en is zichtbaar voor anderen. Gebruik alleen letters, spaties en/of cijfers.
                                </p>
                            </div>

                            <div>
                                <InputLabel for="tag_name" value="Tagnaam"/>
                                <TextInput
                                    id="tagname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tag_name"
                                    required
                                    readonly
                                    tabindex="-1"
                                    placeholder="@brian1991"
                                />
                                <InputError class="mt-1.5" :message="form.errors.tag_name"/>
                                <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                    Je tagnaam wordt gemaakt op basis van je gebruikersnaam en is zichtbaar voor anderen, bijvoorbeeld op je profiel en als je een bericht stuurt.
                                </p>
                            </div>

                            <div>
                                <InputLabel for="email" value="E-mailadres"/>
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                    placeholder="brian@voorbeeld.nl"
                                />
                                <InputError class="mt-1.5" :message="form.errors.email"/>
                                <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                    Je e-mailadres is niet zichtbaar voor anderen.
                                </p>
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
                                    <ul class="text-sm">
                                        <li
                                            :class="{
                                                'text-green-100': passwordValidations.minLength,
                                                'text-blue-700 opacity-60': !passwordValidations.minLength
                                            }"
                                            class="list-disc pl-5"
                                            style="list-style-position: inside"
                                        >
                                            Minimale lengte van 10 tekens
                                        </li>
                                        <li
                                            :class="{
                                                'text-green-100': passwordValidations.hasUppercase,
                                                'text-blue-700 opacity-60': !passwordValidations.hasUppercase
                                            }"
                                            class="list-disc pl-5"
                                            style="list-style-position: inside"
                                        >
                                            Ten minste 1 hoofdletter
                                        </li>
                                        <li
                                            :class="{
                                                'text-green-100': passwordValidations.hasNumber,
                                                'text-blue-700 opacity-60': !passwordValidations.hasNumber
                                            }"
                                            class="list-disc pl-5"
                                            style="list-style-position: inside"
                                        >
                                            Ten minste 1 cijfer
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
                            </div>

                            <!-- Terms and Submit -->
                            <div class="flex items-center">
                                <div class="mt-1">
                                    <Switch
                                        v-model="form.terms_accepted"
                                        :class="form.terms_accepted ? 'bg-green-100' : 'hover:bg-gray-400 bg-gray-300'"
                                        class="relative inline-flex h-[28px] w-[50px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                                    >
                                        <span class="sr-only">Checkbox voor het accepteren van de voorwaarden en het privacybeleid</span>
                                        <span
                                            aria-hidden="true"
                                            :class="form.terms_accepted ? 'translate-x-[22px]' : 'translate-x-0'"
                                            class="pointer-events-none inline-block h-[24px] w-[24px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                                        />
                                    </Switch>
                                </div>
                                <div class="ml-3">
                                    Ik ga akkoord met de <a href="/voorwaarden" class="font-semibold link-underline-green" target="_blank">voorwaarden &nearr;</a> en het <a href="/privacybeleid" class="font-semibold link-underline-green" target="_blank">privacybeleid &nearr;</a>
                                </div>
                            </div>
                            <InputError class="mt-1.5" :message="form.errors.terms_accepted"/>

                            <div class="flex flex-col items-center justify-center gap-y-2">
                                <ButtonOne 
                                    title="Maak mijn gratis account" 
                                    :allowSpinner="!nameExists"
                                    :disableAfterClick="!nameExists"
                                    :class="{ 'pointer-events-none opacity-50': !isFormValid }"
                                />
                                <Link
                                    :href="route('login')"
                                    class="rounded-md text-base font-medium link-underline-green focus:ring-2 focus:ring-blue-700 focus:ring-offset-2"
                                >
                                    Heb je al een account? <span class="hidden lg:inline">Klik</span><span
                                    class="lg:hidden">Tik</span> hier om in te loggen
                                </Link>
                            </div>
                        </div>
                    </form>
                </GradientWhiteElement>
            </GradientElement>
        </div>
    </Layout>
</template>
