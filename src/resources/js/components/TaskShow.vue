<script setup>
import { ref, onMounted } from "vue";
import Button from "./Button.vue";
const props = defineProps({
    taskId: String,
});
const task = ref({});

function getTask() {
    fetch("http://localhost:80/api/tasks/" + props.taskId)
        .then((res) => res.json())
        .then((data) => (task.value = data));
}

onMounted(() => {
    getTask();
});
</script>

<template>
    <v-sheet width="300" class="mx-auto">
        <v-form disabled>
            <v-text-field label="番号" v-model="task.id"></v-text-field>
            <v-text-field label="タイトル" v-model="task.title"></v-text-field>
            <v-text-field label="内容" v-model="task.content"></v-text-field>
            <v-text-field label="担当者" v-model="task.person_in_charge"></v-text-field>
            <Button link="/tasks" block name="戻る" />
        </v-form>
    </v-sheet>
</template>
