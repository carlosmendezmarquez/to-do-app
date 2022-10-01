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
    /**
     * The component renders listItem components using a for loop for every item retrieved from the API
     * */
    import listItem from "./listItem.vue";

    export default {
        /**
         * @property {array} toDos         - List of toDos received from API
         */
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
