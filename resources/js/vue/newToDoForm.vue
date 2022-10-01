<template>
    <div class="addToDo">
        <input type="text" v-model="toDo.name">
        <font-awesome-icon icon="plus-square"
                           @click="addToDo()"
                           :class="[ toDo.name ? 'active':'inactive', 'regular']"/>
    </div>
    <div>
        <span v-if="loading" class="loading">
            <font-awesome-icon icon="fa-compact-disc" size="lg" flip/>
        </span>
    </div>
</template>

<script>
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
            addToDo(){
                this.loading = true;
                if(this.toDo.name == ''){
                    return;
                }
                axios.post('api/to-do/store',{
                    toDo: this.toDo
                })
                .then( resp => {
                    this.loading = false;
                    if( resp.status == 201){
                        this.toDo.name = "";
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
        padding: 5px;
    }

    .regular {
        font-size: 20px;
    }

    .active{
        color: forestgreen;
    }
    .inactive{
        color: dimgray;
    }

    .loading{
        padding: 5px;
        color: darkgray;
    }
</style>
