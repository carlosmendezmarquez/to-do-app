<template>
    <div class="badges">
        <analytics-badge :title="'Tasks Created'" :quantity="this.created" />
        <analytics-badge :title="'Tasks Completed'" :quantity="this.completed"/>
    </div>
    <div class="analyticsLabel">
        <p>From the time range between {{ this.start }} and {{ this.end }}.</p>
    </div>
    <div class="formContainer">
        <analytics-form
                   v-on:searchNow="getAnalytics" />
    </div>


</template>

<script>
    import analyticsForm from "./analyticsForm";
    import analyticsBadge from "./analyticsBadge";

    export default{
        components: {
            analyticsForm,
            analyticsBadge
        },
        data: function (){
            return{
                start: "",
                end: "",
                created: 0,
                completed: 0
            }
        },
        methods: {
            getAnalytics(date){
                let startDate = "";
                let endDate = "";
                if(date){
                    startDate = `${date[0].getFullYear()}-${date[0].getMonth() + 1}-${date[0].getDate()}`;
                    endDate = `${date[1].getFullYear()}-${date[1].getMonth() + 1}-${date[1].getDate()}`;
                }
                axios.get('api/to-dos/analytics?'+'start_date='+startDate+'&end_date='+endDate)
                    .then(resp => {
                        this.created = resp.data.created;
                        this.completed = resp.data.completed;
                        this.start = resp.data.start_date;
                        this.end = resp.data.end_date;
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
            this.getAnalytics();
        }
    }
</script>

<style scoped>
    .badges{
        display: flex;
    }
</style>
