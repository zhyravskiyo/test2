<template>
    <ul>
        <li v-for="(value,key) in items">
            <a v-bind:href="key" class="">{{value}}</a>
        </li>
    </ul>
</template>
<!-- render menu -->
<script>
    export default {
        data(){
            return{
                items : {
                    '/clients': "Clients",
                    '/home': "Home"
                }
            }
        }
    }
</script>
