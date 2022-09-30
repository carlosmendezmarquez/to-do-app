<template>
    <div>
        <div v-for="(toDo,index) in toDos" :key="index">
            <list-item
                :toDo="toDo"
                class="item"
                v-on:itemChanged="$emit('reloadContent')"
            />
        </div>
    </div>
</template>

<script>
    import listItem from "./listItem.vue";

    export default {
        props: ['toDos'],
        components: {
            listItem
        }
    }
</script>

<style scoped>
    .item{
        background: whitesmoke;
        padding: 5px;
        margin-top: 5px;
    }
</style>
