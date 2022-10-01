<template>
    <label>Select a time range:</label>
    <Datepicker v-model="date" range />
    <button @click="searchDates(date)">Search</button>
</template>

<script>
    import { ref, onMounted } from 'vue';

    export default{
        // data: function(){
        //     return{
        //         date: ""
        //     }
        // },
        emits: ["searchNow"],
        setup() {
            const date = ref();
            onMounted(() => {
                const endDate = new Date();
                const startDate = new Date(new Date().setDate(endDate.getDate() - 7));

                date.value = [startDate, endDate];
            })

            return {
                date,
            }
        },
        methods: {
            searchDates(date){
                this.$emit('searchNow',date)
            }
        }
    }
</script>
