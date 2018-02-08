<template>
    <vue-tree-navigation :items="items" :defaultOpenLevel="defaultOpenLevel" />
</template>

<script>
import VueTreeNavigation from 'vue-tree-navigation';
import axios from 'axios';

export default {
    components: { VueTreeNavigation },

    data() {
        return {
            items: [
            ],
            defaultOpenLevel: 0
        }
    },

    created() {
        axios.get('/admin/department/tree')
             .then(response => {
                 this.items = response.data;
             });
    }
}
</script>

<style>

</style>
