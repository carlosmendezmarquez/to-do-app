<template>
    <label>Select a time range:</label>
    <Datepicker v-model="date" range :enableTimePicker="false"/>
    <button @click="searchDates(date)">Search</button>
</template>

<script>
    /**
     * The component renders a Datepicker component and a button with an event to trigger a new search
     * */
    import { ref, onMounted } from 'vue';

    export default{
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
                /**
                 * Triggers when the search button is clicked
                 *
                 * @param {array} date
                 */
                this.$emit('searchNow',date)
            }
        }
    }
</script>

<style scoped>
    button {
        color: #fff;
        opacity: .9;
        background: #19a448;
        border: 0;
        border-radius: 3px;
        margin: 2em 0 0 45%;
        padding: 1em 2em;
        font-size: 18px;
    }
    button:hover{
        background: #21f466;
        color: #184026;
    }
</style>
