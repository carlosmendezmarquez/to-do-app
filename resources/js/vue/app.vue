<template>
    <div class="listContainer">
        <div class="heading">
            <div class="navBar">
                <nav-menu :page="page"
                @set-page="setPage"/>
            </div>
            <h1 class="title">To Do App</h1>

        </div>
        <div class="content">
            <div v-if="this.page==='list'">
                <new-to-do-form
                    v-on:reloadContent="getList()" />
                <list-view :toDos="toDos"
                           v-on:reloadContent="getList()" />
            </div>
            <analytics-view v-if="this.page==='analytics'"
            />
        </div>

    </div>
</template>

<script>
    import newToDoForm from "./newToDoForm";
    import listView from "./listView";
    import navMenu from "./navMenu";
    import analyticsView from "./analyticsView"
    export default {
        components: {
            newToDoForm,
            listView,
            navMenu,
            analyticsView
        },
        data: function (){
            return{
                toDos: [],
                page: "list"
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
            },
            setPage(page){
                this.page = page;
            }
        },
        created(){
            this.getList();
        }
    }
</script>
<style scoped>
    .listContainer{
        width: 450px;
        margin: auto;
    }

    .heading,.content{
        padding: 2em;
        background: lightgray;
    }

    #title{
        text-align: center;
    }

    .navBar{
        float: right;
    }
</style>
