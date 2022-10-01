<template>
    <div class="listContainer">
        <div class="heading">
            <div class="navBar">
                <nav-menu :page="page"
                @set-page="setPage"/>
            </div>
            <div><p class="title shadow">To Do List</p></div>
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
        <div class="footer">
            <p>Made by CarlosM</p>
        </div>
    </div>
</template>

<script>
    /**
     * Main component of the App
     */
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
                /**
                 * @property {array} toDos      - Contains the values of the to-dos list incoming from API
                 * @property {string} page      - The selected page to display. @values list, analytics
                 */
                toDos: [],
                page: "list"
            }
        },
        methods: {
            /**
             * Gets called when create component, add or delete to-dos.
             * Retrieve the list of To-Dos from the API using a GET request
             */
            getList(){
                axios.get('api/to-dos')
                    .then(resp => {
                        this.toDos = resp.data;
                    })
                    .catch( e => {
                        consolelog(e);
                    })
            },
            /**
             * Gets called when user click any menu button
             */
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
    @import url('https://fonts.googleapis.com/css?family=Ubuntu');
    @import url('https://fonts.googleapis.com/css?family=Lato');
    h1,h2,h3,h4 {
        font-family: 'Ubuntu', sans-serif;
    }
    .listContainer{
        width: 66%;
        margin: 2em auto;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        font-family: 'Lato', sans-serif;
    }

    .heading,.content{
        padding: 2em;
        background: white;
    }

    .title{
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.1;
        max-inline-size: 15ch;
        font-family: 'Ubuntu', sans-serif;
        color: #40db94;
    }

    .shadow {
        text-shadow: .1em .1em 0 hsl(150 50% 30%);
    }

    .navBar{
        float: right;
    }
    .footer{
        border-top: 1px solid #e4eaec;
        text-align: right;
    }
    .footer p{
        padding: 10px;
        color: dimgray;
    }
</style>
