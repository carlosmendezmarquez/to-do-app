<template>
    <ul>
        <li
            :class="[page==='list'?'active':'','menu-item']"
            @click="setPage('list')">
            <h3>List</h3>
        </li>
        <li
            :class="[page==='analytics'?'active':'','menu-item']"
            @click="setPage('analytics')">
            <h3>Analytics</h3>
        </li>
    </ul>
</template>

<script>
    export default{
        props: ['page'],
        methods: {
            setPage(newPage){
                this.$emit('set-page',newPage)
            }
        }
    }
</script>

<style scoped>

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    li {
        float: left;
    }

    .menu-item{
        display: block;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        cursor: pointer;
    }
    .menu-item:hover{
        background: dimgray;
        color: lightgray;
    }
    .active {
        border-bottom: 3px solid forestgreen;
    }
</style>
