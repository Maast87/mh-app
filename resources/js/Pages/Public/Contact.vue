<script setup>
    import { Head, useForm, usePage } from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import { provide } from "vue";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import InputError from "@/Components/InputError.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import Textarea from "@/Components/Textarea.vue";
    import Options from "@/Components/Options.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "contact" },
    ];
    provide('breadcrumbs', breadcrumbs);

    const { props } = usePage();

    const form = useForm({
        name: props.auth.user.name || '',
        email: props.auth.user.email || '',
        body: '',
        messageType: '',
        service: '',
    });

    const messageTypeOptions = [
        { value: 'Een vraag', label: 'Een vraag' },
        { value: 'Een compliment', label: 'Een compliment' },
        { value: 'Een melding over dat iets niet meer goed werkt', label: 'Een melding over dat iets niet meer goed werkt' },
        { value: 'Een klacht', label: 'Een klacht' },
        { value: 'Iets anders', label: 'Iets anders' },
    ];

    const serviceOptions = [
        { value: 'Me-learning en het platform', label: 'Me-learning en het platform' },
        { value: 'Coaching', label: 'Coaching' },
        { value: 'Supportgroepen', label: 'Supportgroepen' },
        { value: 'Iets anders', label: 'Iets anders' },
    ];

</script>

<template>
    <Layout>
        <Head tag="Contact" />

        <GradientHero>
            <template v-slot:subtitle>
                Hoe kunnen we je helpen?
            </template>
            <template v-slot:title>
                Contact met<br>Mental Hygiene
            </template>
        </GradientHero>

        <DarkblueElement class="items-center">
            <p class="text-header_l text-gray-100 font-bold text-center">
                We horen <br><span class="gradient-text">graag</span> van je
            </p>

            <GradientElement class="lg:w-1/2">
                <GradientWhiteElement>
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
                            />
                            <InputError class="mt-1" :message="form.errors.name" />
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
                            />
                            <InputError class="mt-1" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="messageType" value="Wat voor soort bericht wil je ons sturen?" />

                            <Options
                                id="messageType"
                                :options="messageTypeOptions"
                                v-model="form.messageType"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-1" :message="form.errors.messageType" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="service" value="Over welke dienst wil je een vraag stellen?" />

                            <Options
                                id="service"
                                :options="serviceOptions"
                                v-model="form.service"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-1" :message="form.errors.service" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Wat is je bericht?" />

                            <Textarea
                                id="body"
                                type="textarea"
                                class="mt-1 block w-full"
                                v-model="form.body"
                                required
                                placeholder="Type hier je bericht..."
                            />
                            <InputError class="mt-1" :message="form.errors.body" />
                        </div>

                        <div class="mt-6 flex flex-col items-center justify-center gap-y-2">
                            <button
                                class="button-one w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Versturen
                            </button>
                        </div>
                    </form>
                </GradientWhiteElement>
            </GradientElement>

        </DarkblueElement>

    </Layout>
</template>
