<template>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                New Note
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" v-model="note.content" name="content" id="note" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority" class="col-sm-3">Priority</label>
                        <div class="col-sm-3">
                            <select name="priority" id="priority" class="form-control input-sm" v-model="note.priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" @click="create" class="btn btn-success">Add Note</button>
                    <button type="button" @click="cancel" class="btn btn-danger pull-right">Cancel</button>
                </div>
            </div>
        </div>
        <br />
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id', 'product'],

    data() {
      return {
        note: {
            product_id: this.id,
            product_type: this.product,
            priority: 'low',
            content: this.content
        }
      }
    },

    methods: {
        create() {
            const data = {
                content: this.note.content,
                priority: this.note.priority,
                product_id: this.note.product_id,
                product_type: this.note.product_type
            }

            axios.post('/admin/notes/', data).then(response => {
                this.$emit('updated');
            });
        },

        cancel() {
            this.$emit('cancelled');
        }
    }
}
</script>
