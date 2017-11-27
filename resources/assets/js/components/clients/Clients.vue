<template >
    <div>
        <form v-for="product in products" class="product">
            <input v-model="firstName">
            <input v-model="secondName">
            <input v-model="personalCode">
            <input v-model="email" type="email">
            <input v-model="address">
            <input v-model="city">
            <input v-model="country">
            <input v-model="createAt">
            <input v-model="updateAt">

            <button type="button" @click="create(product)">create</button>
        </form>

        <form v-for="product in products" class="product">
            <span>{{product.id}}</span>
            <input v-model="firstName">
            <input v-model="secondName">
            <input v-model="personalCode">
            <input v-model="email" type="email">
            <input v-model="address">
            <input v-model="city">
            <input v-model="country">
            <input v-model="createAt">
            <input v-model="updateAt">

            <button type="button" @click="save(product)">save</button>
            <button type="button" @click="delete(product)">delete</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products:[]
            };
        },

        mounted(){
            this.prepareComponent();
        },

        ready() {
            this.prepareComponent();
        },

        methods:{
            prepareComponent(){
                this.getProducts();
            },

            getProducts(){
                axios.get('api/clients').then(
                    response => {
                        this.products = response.data;
                    }
                );
            },
        },
    }
</script>
