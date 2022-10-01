<template>
    <div class="badges">
        <analytics-badge :title="'Tasks Created'" :quantity="this.created" :icon="'fa-square-check'"/>
        <analytics-badge :title="'Tasks Completed'" :quantity="this.completed" :icon="'fa-list'"/>
    </div>
    <div class="analyticsLabel">
        <p>Results from the time range between <span>{{ this.start }}</span> and <span>{{ this.end }}</span>.</p>
    </div>
    <div class="formContainer">
        <analytics-form
                   v-on:searchNow="getAnalytics" />
    </div>


</template>

<script>
    /**
     * The component displays the main view of the analytics page, the analyticsBadges components
     * receives their respective values to render correctly. Also the analyticsForm component is
     * rendered.
     * */
    import analyticsForm from "./analyticsForm";
    import analyticsBadge from "./analyticsBadge";

    export default{
        components: {
            analyticsForm,
            analyticsBadge
        },
        data: function (){
            /**
             * @property {string} start         - Start date
             * @property {string} end           - End date
             * @property {int} created          - Amount of to-dos created
             * @property {int} completed        - Amount of to-dos completed
             */
            return{
                start: "",
                end: "",
                created: 0,
                completed: 0
            }
        },
        methods: {
            /**
             * Triggers when the search button is clicked and when component is rendered
             *
             * @param {array} date
             */
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
    .analyticsLabel{
        font-size: 1.5em;
    }
    .analyticsLabel span{
        color: #1e5936;
        font-weight: bold;
    }
</style>
