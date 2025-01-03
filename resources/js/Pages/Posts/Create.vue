<script setup>
    import Modal from "@/Components/Modals/ModalLayout.vue";
    import {useForm} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputError from "@/Components/InputError.vue";
    import {ref} from "vue";
    import MarkdownEditor from "@/Components/MarkdownEditor.vue";
    import Options from "@/Components/Options.vue";

    const props = defineProps(['topics']);

    const form = useForm({
        title: '',
        topic_id: props.topics[0]?.id || null,
        body: '',
    });

    const isModalVisible = ref(false);
    const modalMessage = ref("");

    const createPost = () => form.post(route('posts.store'));

    const topicOptions = props.topics.map(topic => ({
        value: topic.id,
        label: topic.name,
    }));
</script>

<template>
    <Head title="Create a post"/>

    <Layout>
        <h1 class="text-header_s">Create a post</h1>

        <form @submit.prevent="createPost">
            <div class="mt-4">
                <InputLabel for="title" class="sr-only">Title</InputLabel>
                <TextInput id="title" class="w-full" v-model="form.title" placeholder="Awesome title..."/>
                <InputError :message="form.errors.title" class="mt-1"/>
            </div>

            <div class="mt-4">
                <InputLabel for="topic_id" value="Select a category"/>

                <Options
                    id="topic_id"
                    :options="topicOptions"
                    v-model="form.topic_id"
                    class="mt-1 block w-full"
                    required
                />

                <InputError :message="form.errors.topic_id" class="mt-1"/>
            </div>

            <div class="mt-4">
                <InputLabel for="body" class="sr-only">Message</InputLabel>
                <MarkdownEditor v-model="form.body"/>
                <InputError :message="form.errors.body" class="mt-1"/>
            </div>

            <div>
                <ButtonOne type="submit" title="Create post"/>
            </div>
        </form>
    </Layout>

    <!-- Modal -->
    <Modal :show="isModalVisible" @close="isModalVisible = false">
        <template #default>
            <div class="p-4">
                <h3 class="text-lg font-medium">{{ modalMessage }}</h3>
                <div class="mt-4 text-right">
                    <ButtonOne @click="isModalVisible = false" title="Close"/>
                </div>
            </div>
        </template>
    </Modal>
</template>
