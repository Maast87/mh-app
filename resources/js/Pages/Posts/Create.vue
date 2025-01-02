<script setup>
    import Modal from "@/Components/Modals/ModalLayout.vue";
    import {useForm} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputError from "@/Components/InputError.vue";
    import Textarea from "@/Components/Textarea.vue";
    import {ref} from "vue";

    const form = useForm({
       title: '',
       body: '',
    });

    const isModalVisible = ref(false);
    const modalMessage = ref("");

    const createPost = () => form.post(route('posts.store'));

</script>

<template>
    <Head title="Create a post" />

    <Layout>
        <h1 class="text-header_s">Create a post</h1>

        <form @submit.prevent="createPost">
            <div class="mt-4">
                <InputLabel for="title" class="sr-only">Titel</InputLabel>
                <TextInput id="title" class="w-full" v-model="form.title" placeholder="Awesome titel..." />
                <InputError :message="form.errors.title" class="mt-1" />
            </div>
            <div class="mt-4">
                <InputLabel for="body" class="sr-only">Bericht</InputLabel>
                <Textarea id="body" rows="25" v-model="form.body" placeholder="Schrijven maar..." />
                <InputError :message="form.errors.body" class="mt-1" />
            </div>
            <div>
                <ButtonOne type="submit" title="Create post" />
            </div>
        </form>
    </Layout>

    <!-- Modal -->
    <Modal :show="isModalVisible" @close="isModalVisible = false">
        <template #default>
            <div class="p-4">
                <h3 class="text-lg font-medium">{{ modalMessage }}</h3>
                <div class="mt-4 text-right">
                    <ButtonOne @click="isModalVisible = false" title="Close" />
                </div>
            </div>
        </template>
    </Modal>
</template>
