<template>
    <div class="listContainer">
        <div class="heading">
            <h1 class="title">To Do List <small>by Carlos</small></h1>
            <new-to-do-form
                v-on:reloadContent="getList()" />
        </div>
        <list-view :toDos="toDos"
         v-on:reloadContent="getList()" />
    </div>
</template>

<script>
    import newToDoForm from "./newToDoForm";
    import listView from "./listView";
    export default {
        components: {
            newToDoForm,
            listView
        },
        data: function (){
            return{
                toDos: []
            }
        },
        methods: {
            getList(){
                axios.get('api/to-dos')
                    .then(resp => {
                        this.toDos = resp.data;
                    })
                    .catch( e => {
                        consolelog(e);
                    })
            }
        },
        created(){
            this.getList();
        }
    }
</script>
<style scoped>
    .listContainer{
        width: 350px;
        margin: auto;
    }

    .heading{
        padding: 2em;
        background: lightgray;
    }

    #title{
        text-align: center;
    }
</style>
