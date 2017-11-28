<style>
    .timestamp{
        border: dashed;
        border-color: #2a88bd;
    }
</style>
<template>

    <div>
        <!-- form for create new product -->
        <div name="newClient" class="client" method="post">
            <label>fierst name<br>
                <input v-model="newClient.firstName">
            </label>
            <label>second name<br>
                <input v-model="newClient.secondName">
            </label>
            <label>personal code<br>
                <input v-model="newClient.personalCode">
            </label>
            <label>email<br>
                <input v-model="newClient.email" type="email">
            </label>
            <label>address<br>
                <input v-model="newClient.address">
            </label>
            <label>city<br>
                <input v-model="newClient.city">
            </label>
            <label>country<br>
                <input v-model="newClient.country">
            </label>

            <button type="button" v-on:click="create()">create</button>
        </div>
        <!-- form for change product -->
        <div v-for="client in clients" class="client">
            <label>id</label>
            <label>{{client.id}}</label>
            <label>fierst name<br>
                <input v-model="client.firstName">
            </label>
            <label>second name<br>
                <input v-model="client.secondName">
            </label>
            <label>personal code<br>
                <input v-model="client.personalCode">
            </label>
            <label>email<br>
                <input v-model="client.email" type="email">
            </label>
            <label>address<br>
                <input v-model="client.address">
            </label>
            <label>city<br>
                <input v-model="client.city">
            </label>
            <label>country<br>
                <input v-model="client.country">
            </label>
            <label>create time<br>
                <span class="timestamp">{{client.createdAt}}</span>
            </label>
            <label>update time<br>
                <span class="timestamp">{{client.updatedAt}}</span>
            </label>
            <button type="button" v-on:click="save(client)">save</button>
            <button type="button" v-on:click="destroy(client)">delete</button>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                newClient: {
                    firstName: '',
                    secondName: '',
                    personalCode: '',
                    email: '',
                    address: '',
                    city: '',
                    country: '',
                },
                clients: [],
            };
        },

        mounted() {
            this.prepareComponent();
        },

        ready() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                this.getClients();
            },

            getClients() {
                <!-- load data or show error -->
                axios.get('/api/clients')
                    .then(response => {
                        this.clients = response.data;
                    })
                    .catch(function (error) {
                        alert(error.response.data['error']);
                    });
            },

            create() {
                <!-- create new product or show error -->
                axios.post('/api/client', JSON.stringify(this.newClient))
                    .then(response => {
                        this.clients = this.getClients();
                        this.newClient = {
                            firstName: '',
                            secondName: '',
                            personalCode: '',
                            email: '',
                            address: '',
                            city: '',
                            country: '',
                        }
                    })
                    .catch(function (error) {
                        alert(error.response.data['error']);
                    });
            },

            destroy(client) {
                <!-- delete client or show error -->
                axios.delete('/api/client/' + client.id)
                    .then(response => {
                        this.clients = this.getClients();
                    })
                    .catch(function (error) {
                        alert(error.response.data['error']);
                    });
            },
            <!-- update client or show error -->
            save(client) {
                axios.put('/api/client/' + client.id, JSON.stringify(client))
                    .then(response => {
                        this.clients = this.getClients();
                    })
                    .catch(function (error) {
                        alert(error.response.data['error']);
                    });
            },
        },
    }
</script>
