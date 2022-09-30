<template>
    <div class="item">
        <input type="checkbox"
        @change="updateCheck()"
        v-model="toDo.completed"
        v-if="toDo.status==='pending'"/>
        <span :class="[toDo.status==='completed'? 'completed':'','itemText']"> {{ toDo.name }}</span>
        <button @click="removeItem()" class="trashCan">
            <font-awesome-icon icon="trash"/>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['toDo'],
        methods: {
            updateCheck(){
                axios.put('api/to-do/'+ this.toDo.id,{
                    toDo: this.toDo
                })
                    .then( resp => {
                        if( resp.status === 200){
                            this.$emit('itemChanged');
                        }
                    })
                    .catch( e => {
                        console.log(e);
                    })
            },
            removeItem(){
                axios.delete('api/to-do/'+ this.toDo.id)
                    .then( resp => {
                        if(resp.status === 200){
                            this.$emit('itemChanged');
                        }
                    })
                    .catch( e => {
                        console.log(e);
                    })
            }
        }
    }
</script>

<style scoped>
    .completed{
        text-decoration: line-through;
        color: gray;
    }
    .itemText{
        width: 100%;
        margin-left: 20px;
    }
    .item {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .trashCan{
        background: whitesmoke;
        border: none;
        color: red;
        outline: none;
    }
</style>
