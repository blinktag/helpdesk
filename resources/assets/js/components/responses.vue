<template>
    <div class="col-sm-12">
        <response v-for="(response, index) in items" :key="response.id" :data="response" @deleted="remove(index)" />
    </div>
</template>

<script>
import axios from 'axios';
import Response from './response.vue';
import collection from '../mixins/collection';

export default {

    props: ['ticketid'],

    mixins: [collection],

    components: { Response },

    data() {
        return {
            items: []
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get(`/admin/ticket/${this.ticketid}`)
                 .then(response => {
                     this.items = response.data.data.responses;
                 });
        }
    }
}
</script>
