<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import {Head, useForm} from '@inertiajs/vue3';
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "log in", href: "/login" },
        { label: "wachtwoord vergeten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    defineProps({
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
    });

    const submit = () => {
        form.post(route('password.email'));
    };
</script>

<template>
    <Layout>
        <Head title="Forgot Password" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue-700 text-center">Wachtwoord <span class="gradient-text">vergeten</span></h1>
                <p class="text-base text-blue-700 text-center">Oeps, dat gebeurt iedereen weleens. Vul hieronder je e-mailadres in,<br>dan sturen we je een mail waarmee je je wachtwoord kunt resetten.</p>
            </div>

            <div class="gradient-background rounded-2xl p-3 lg:w-1/2">
                <div class="flex flex-col bg-gray-100 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">

                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600"
                    >
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

                        <div class="mt-4 flex items-center justify-end">
                            <button
                                class="button-primary w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Verstuur wachtwoord reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
