<template>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm" title="Edit Note" @click="editing = true" v-if="editing == false">
                    <i class="fa fa-edit"></i>
                </a>
                Note By {{ data.author }} - <span v-text="ago"></span>
                <a @click="destroy" class="btn btn-danger btn-sm pull-right">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
            <div class="card-body">
                <div v-if="editing == false" v-html="note.content"></div>
                <div v-else-if="editing == true" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" v-model="note.content" name="content" rows="10"></textarea>
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

                    <button type="button" @click="update" class="btn btn-success">Save Changes</button>
                    <button type="button" @click="editing = false" class="btn btn-danger">Discard Changes</button>
                </div>
            </div>
        </div>
        <br />
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    props: ['data'],

    data() {
      return {
        editing: false,
        id: null,
        note: this.data
      }
    },

    computed: {
        ago() {
            console.log(this.note.created_at);
            return moment.unix(this.note.created_at).format('MMMM Do YYYY, h:mm:ss a');
        }
    },

    methods: {
        update() {
            const data = {
                content: this.note.content,
                priority: this.note.priority
            }

            axios.put(`/admin/notes/${this.note.id}`, data).then(response => {
                if (response.data.data) {
                    this.note = response.data.data;
                    this.editing = false;
                }
            });
        },

        destroy() {
            swal({
              title: "Are you sure?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              animation: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                axios.delete(`/admin/notes/${this.note.id}`).then(response => {
                    this.$emit('deleted', this.note.id);
                });
              }
            });
        }
    }
}
</script>

<style lang="scss" scoped>
.btn {
    i {
        color: #fff;
    }
}
</style>
