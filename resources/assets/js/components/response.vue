<template>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td width="20%" v-if="author_type == 'App\Admin'">
                    <div class="text-center">
                        <p>
                            <img :src="gravatar_url" class="rounded" />
                        </p>
                        <p>
                            <b>{{ author }}</b>
                        </p>
                    </div>
                </td>
                <td width="20%" v-else>
                    <div class="text-center">
                        <p>
                            <img :src="gravatar_url" class="rounded-circle" />
                        </p>
                        <p>{{ author }}</p>
                    </div>
                </td>
                <td valign="top" class="response">
                    <div class="response__content" v-if="editing == false">
                        <div class="response__content__body">
                            {{ content }}
                        </div>

                        <div class="response__content__attachments" v-if="attachments.length > 0">
                            <div class="dropdown show pull-right">
                                <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-pill badge-light" v-text="attachments.length"></span>
                                    Attachments
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#" v-for="(attachment, index) in attachments" :key="index">
                                            <i class="fa fa-file-pdf-o"></i>
                                            {{ attachment.name }}
                                            ({{ attachment.size }}KB)
                                        </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div v-if="editing == true">
                        <textarea class="response__edit" v-model="content"></textarea>
                        <br />
                        <button type="button" class="btn btn-success" @click="update">
                            Save Changes
                        </button>
                        <button type="button" class="btn btn-danger pull-right" @click="discard">
                            Discard Changes
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" title="Edit Response" @click="editing=true">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-default pull-right" data-toggle="tooltip" title="Delete Response" @click="destroy">
                        <i class="fa fa-trash-o"></i>
                        Delete
                    </button>
                </td>
                <td>
                    {{ created_at }}
                    <span class="float-right">
                        {{ from }}
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
import axios from 'axios';

export default {
    props: ['data'],

    data() {
        return {
            'original': this.data.content,
            'editing': false,
            ...this.data
        }
    },

    methods: {
        discard() {
            this.content = this.original;
            this.editing = false;
        },
        update() {
            const post_data = {
                content: this.content
            }

            axios.put(`/admin/responses/${this.id}`, post_data)
                 .then(response => {
                     if (response.data.data) {
                         this.content = response.data.data.content;
                     }

                     this.editing = false;
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
                axios.delete(`/admin/responses/${this.id}`).then(response => {
                    this.$emit('deleted', this.id);
                });
              }
            });
        }
    }
}
</script>

<style lang="scss" scoped>
textarea {
    width:100%;
    min-height: 200px;
    background-color: #fbfde4;
}
</style>
