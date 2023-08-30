<script setup>
import { ref, onMounted } from "vue";
import Button from "./Button.vue";
const tasks = ref([]);

function getTasks() {
    fetch("http://localhost:80/api/tasks")
        .then((res) => res.json())
        .then((json) => (tasks.value = json))
        .then((tasks) => console.log(tasks));
}

onMounted(() => {
    getTasks();
});

function deleteTask(id) {
    fetch("http://localhost:80/api/tasks/" + id, {
        method: "DELETE",
    }).then((res) => getTasks());
}
</script>

<template>
    <v-table>
        <thead>
            <tr>
                <th>番号</th>
                <th>タイトル</th>
                <th>内容</th>
                <th>担当者</th>
                <th>詳細</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in tasks" :key="task.id">
                <th>{{ task.id }}</th>
                <td>{{ task.title }}</td>
                <td>{{ task.content }}</td>
                <td>{{ task.person_in_charge }}</td>
                <td><Button :link="'/tasks/' + task.id" name="詳細" /></td>
                <td>
                    <Button :link="'/tasks/' + task.id + '/edit'" name="編集" />
                </td>
                <td><Button name="削除" @click="deleteTask(task.id)" /></td>
            </tr>
        </tbody>
    </v-table>
</template>
