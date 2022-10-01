<template>
    <div class="addToDo">
        <label>Enter a new To Do:</label>
        <input type="text" v-model="toDo.name" placeholder="e.g. Learn something new ">
        <font-awesome-icon icon="plus-square"
                           @click="addToDo()"
                           :class="[ toDo.name ? 'active':'inactive', 'regular']"/>
    </div>
    <div class="loadingContainer">
        <span v-if="loading" class="loading">
            <font-awesome-icon icon="fa-compact-disc" size="lg" flip/>
        </span>
    </div>
</template>

<script>
    /**
     * The component displays an input text and button to add new to-do items
     */
    export default {
        data: function(){
            return{
                toDo: {
                    name: ""
                },
                loading: false
            }
        },
        emits: ["reloadContent"],
        methods:{
            /**
             * Triggers when user add a new To Do
             * */
            addToDo(){
                this.loading = true;
                if(this.toDo.name === ''){
                    this.loading = false;
                    return;
                }
                axios.post('api/to-do/store',{
                    toDo: this.toDo
                })
                .then( resp => {
                    this.loading = false;
                    if( resp.status === 201){
                        this.toDo.name = "";
                        /**
                         * Triggers when get the list of To-Dos
                         */
                        this.$emit('reloadContent');
                    }
                })
                .catch( e =>{
                    this.loading =  false;
                    console.log(e);
                })
            }
        }

    }
</script>

<style scoped>
    .addToDo{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    input{
        color: #76838f;
        background-color: #fff;
        border: 1px solid #e4eaec;
        border-radius: 3px;
        width: 100%;
        margin-right: 10px;
        padding: 10px;
    }

    .regular {
        font-size: 40px;
    }

    .active{
        color: forestgreen;
    }
    .inactive{
        color: dimgray;
    }
    .loadingContainer{
        padding: 20px;
    }
    .loading{
        padding: 5px;
        color: darkgray;
    }
</style>
