<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import {provide} from "vue";

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

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>

<template>
    <Layout>
        <Head title="Log in" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue-700 text-center"><span class="gradient-text">Log in</span> bij Mental Hygiene</h1>
                <p class="text-base text-blue-700">Alles over mentale ontwikkeling op één plek</p>
                <p class="text-base text-blue-700">Nog geen account? Registreer je <Link href="/registreren" class="link-underline-green font-semibold">hier</Link>.</p>
            </div>

            <div class="gradient-background rounded-2xl p-3 lg:w-1/2">
                <div class="flex flex-col bg-gray-100 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">

                    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                        {{ status }}
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

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-base text-blue-700"
                                    >Onthoud mij</span>
                            </label>
                        </div>

                        <div class="mt-6 flex flex-col items-center justify-center gap-y-2">
                            <button
                                class="button-primary w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </button>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="rounded-md text-base font-medium link-underline-green focus:ring-2 focus:ring-blue-700 focus:ring-offset-2"
                            >
                                Wachtwoord vergeten?
                            </Link>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
