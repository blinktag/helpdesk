<template>
    <div>

            <div class="col-sm-6">
                <button class="btn btn-primary" @click="showNew = true" v-if="showNew == false">
                    <i class="fa fa-plus"></i>
                    Add Note
                </button>
            </div>
        <br />
        <div v-if="showNew == true">
            <new-note :id="id" :product="product" @updated="fetch" @cancelled="showNew = false"></new-note>
        </div>
        <div @updated="fetch" v-if="items.length">
            <div v-for="(note, index) in items" :key="index">
                <note :data="note" @deleted="remove(index)" :key="note.id"></note>
            </div>
        </div>
        <div v-if="!items.length && showNew === false">
            <div class="col-sm-12">
                <div class="card card-body bg-light text-center">
                    No notes
                </div>
            </div>
            <br />
        </div>
    </div>
</template>

<script>
    import Note from './note.vue';
    import NewNote from './new-note.vue';
    import collection from '../mixins/collection';
    import axios from 'axios';

    export default {
        components: { Note, NewNote },

        props: ['id', 'product'],

        mixins: [collection],

        data() {
            return {
                items: [],
                showNew: false
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                this.showNew = false;
                let url = ''
                switch(this.product) {
                    case 'ticket':
                        url = `/admin/ticket/${this.id}/notes`;
                        break;
                    case 'user':
                        url = `/admin/users/${this.id}/notes`;
                        break;
                }

                axios.get(url)
                     .then(response => {
                        this.items = [];
                        this.items = response.data.data;
                     });
            }
        }

    }
</script>
