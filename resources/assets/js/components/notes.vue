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
            <new-note :id="id" @updated="fetch" @cancelled="showNew = false"></new-note>
        </div>
        <div @updated="fetch" v-if="items.length">
            <div v-for="(note, index) in items" :key="index">
                <note :data="note" @deleted="remove(index)" :key="note.Id"></note>
            </div>
        </div>
        <div v-if="!items.length && showNew === false" class="well text-center">
            No notes
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

        props: ['id'],

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

                axios.get(`/admin/ticket/${this.id}/notes`)
                     .then(response => {
                        this.items = [];
                        this.items = response.data.data;
                     });
            }
        }

    }
</script>
