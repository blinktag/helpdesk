<template>
    <div class="form-group col-md-6 float-right">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Attach A File</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="ticket_attachment" @change="changeName">
                <label class="custom-file-label" v-text="name"></label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: 'Choose file',
        }
    },
    methods: {
        changeName(e) {
            this.name = e.target.files[0].name;
        }
    }
}
</script>
