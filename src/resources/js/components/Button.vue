<script setup>
    const props = defineProps({
        link: String,
        name: String,
    });
</script>
<template>
    <v-btn variant="outlined" :to="link">{{ name }}</v-btn>
</template>
