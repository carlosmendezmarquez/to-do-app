<template>
    <div class="badgeContent">
        <div class="badgeIcon">
            <font-awesome-icon :icon="icon" size="2xl"/>
        </div>
        <div class="badgeTitle">
            <h2> {{this.title}}</h2>
        </div>
        <div class="badgeBody">
            <h1> {{this.quantity}}</h1>
        </div>
    </div>
</template>

<script>
    /**
     * The component displays an icon, title and quantity received from its parent component
     * */
    export default{
        /**
         * @property {string} title         - The title of the badge
         * @property {string} quantity      - The quantity obtained from its parent component
         * @property {string} icon          - The icon to render
         */
        props:['title','quantity','icon']
    }
</script>
<style scoped>
    .badgeContent {
        flex: 1;
    }
    .badgeTitle,.badgeBody,.badgeIcon{
        width: 100%;
        text-align: center;
    }
    .badgeBody h1{
        font-size: 3em;
    }
</style>
