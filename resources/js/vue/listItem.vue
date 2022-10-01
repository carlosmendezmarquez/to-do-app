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
    /**
     * Single component to display every entry on the To-Do list
     * */
    export default {
        /**
         * @property {object} toDo         - To-Do obtained from the list
         */
        props: ['toDo'],
        methods: {
            /**
             * Triggered when the user click the checkbox on any listItem component.
             * Send the PUT request to update the status of the To-Do and trigger the itemChanged emit
             * to reload the content of the list
             */
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
            /**
             * Triggered when the user click the trash icon of the itemList component
             * Send the DELETE request to erase the To-Do and trigger the itemChanged emit
             * to reload the content of the list
             */
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
        font-size: 1.1em;
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
