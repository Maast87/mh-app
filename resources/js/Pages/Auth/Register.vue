<script setup>
import Layout from "@/Pages/Shared/Layout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from "vue";
import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
import { Switch } from '@headlessui/vue'
import PasswordInput from '@/Components/PasswordInput.vue';

const form = useForm({
    name: '',
    tag_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms_accepted: false,
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

const cleanNameInput = (event) => {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');
    inputValue = inputValue.replace(/\s+/g, ' ');
    form.name = inputValue;
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
                                />
                                <InputError class="mt-1.5" :message="form.errors.name"/>
                                <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                    Je gebruikersnaam is zichtbaar voor anderen. Gebruik alleen letters, spaties en/of cijfers.
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
                                    Je tagnaam wordt gemaakt op basis van je gebruikersnaam en is zichtbaar voor anderen.
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
                                    :allowSpinner="true"
                                    :disableAfterClick="true"
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
