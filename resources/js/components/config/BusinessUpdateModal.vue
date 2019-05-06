<template>
    <modal name="business-update-modal" @before-open="beforeOpen" height="auto">
      <div class="p-4">
        <h2 class="text-xl font-bold">Create Business Unit</h2>
        <div class="mt-4">
            <div>
                <label class="block" for="name">Name:</label>
                <input type="text" name="name"
                class="p-2 rounded w-full"
                :class="form.errors.has('name') ? 'border-2 border-red-500' : 'border'"
                v-model="form.name"
                @keydown="form.errors.clear('name')"
                >
                <span class="text-red-500 text-sm" v-if="form.errors.has('name')" v-text="form.errors.has('name')"></span>

            </div>
            <div class="mt-4">
                <color-picker v-model="form.color" :default="form.color"></color-picker>
                <span class="text-red-500 text-sm" v-if="form.errors.has('color')" v-text="form.errors.has('color')"></span>
            </div>
        </div>
        <div class="mt-8"> 
            <button class="p-2 bg-blue-500 text-white rounded focus:outline-none" @click="save">Save Business Unit</button>
            <button class="p-2 underline focus:outline-none" @click="closeModal">Cancel</button>
        </div>

    </div>
</modal>

</template>

<script>
    import Form from '../../form.js'
    import ColorPicker from '../ColorPicker.vue'

    export default {
        props:[],
        components: {ColorPicker},
        data() {
            return {
                form: new Form({
                    name:'',
                    color:''
                }),
                id:''
            }
        }, 
        methods: {
            save: function() {
                this.form.patch(`/businessunits/${this.id}`, this.form)
            },
            closeModal: function() {
                this.form.reset()
                this.$modal.hide('business-update-modal')
            },
            beforeOpen: function(data) {
                this.form.name = data.params.business.name
                this.form.color = data.params.business.color
                this.id = data.params.business.id
            },

        }
    }
</script>