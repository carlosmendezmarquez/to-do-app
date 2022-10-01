<template>
    <div class="badgeContent">
        <div class="badgeTitle">
            <h2> {{this.title}}</h2>
        </div>
        <div class="badgeBody">
            <h1> {{this.quantity}}</h1>
        </div>
    </div>
</template>

<script>
    export default{
        props:['title','quantity']
    }
</script>
<style scoped>
    .badgeContent {
        flex: 1;
    }
    .badgeTitle,.badgeBody{
        width: 100%;
        text-align: center;
    }
</style>
