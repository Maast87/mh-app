<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
</script>

<template>
    <Layout>
        <div class="flex flex-col">
            <p>
                Het is gelukt
            </p>
            <p v-if="$page.props.auth.user.subscribed">
                You're subscribed
            </p>
            <p v-if="$page.props.auth.user.subscribed_to_monthly">
                You're subscribed to the monthly plan
            </p>
            <p v-if="$page.props.auth.user.subscribed_to_yearly">
                You're subscribed to the yearly plan
            </p>
        </div>

    </Layout>
</template>

<style scoped>

</style>
