<script setup>
    import {Head, useForm} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";

    const form = useForm({
        avatar: null,
    });

    const handleFileChange = (event) => {
        form.avatar = event.target.files[0];
    };

    const submit = () => {
        if (!form.avatar) {
            return;
        }

        form.post('/profile/avatar', {
            preserveScroll: true,
            onSuccess: () => {
                form.reset('avatar');
            }
        });
    };
</script>

<template>
    <Layout>
        <Head title="Upload" />

        <div class="flex flex-col w-full">
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="flex flex-col items-center">
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                            Choose a profile picture
                        </label>
                        <input
                            type="file"
                            id="avatar"
                            @change="handleFileChange"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                            accept="image/*"
                        />
                        <div v-if="form.errors.avatar" class="text-red-500 text-sm mt-1">
                            {{ form.errors.avatar }}
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Uploading...' : 'Upload' }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex justify-center mt-8">
                <div v-if="$page.props.auth.user?.avatar" class="relative">
                    <img 
                        :src="$page.props.auth.user.avatar" 
                        alt="Profile picture" 
                        class="rounded-full w-32 h-32 object-cover border-2 border-gray-200"
                    />
                </div>
                <div v-else class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400">No image</span>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
