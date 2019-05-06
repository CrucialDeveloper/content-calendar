<template>
    <modal name="edit-project-modal" @before-open="beforeOpen" height="auto">
      <div class="p-4">
        <h2 class="text-xl font-bold">Edit Project</h2>
        <div class="mt-4">

         <div class="mb-4">
            <label class="block font-bold" for="owner">Owner:</label>
            <select class="block p-2"  :class="form.errors.has('owner') ? 'border-2 border-red-500' : 'border'" name="owner" id="" v-model="form.owner"  @input="form.errors.clear('owner')">
                <option value="" disabled="">Select Project Owner</option>
                <option :value="fullName(user)" v-for="user in users">{{fullName(user)}}</option>
            </select>
            <span class="text-red-500 text-sm" v-if="form.errors.has('owner')" v-text="form.errors.has('owner')"></span>
        </div>   

        <div class="mb-4">
            <label class="block font-bold" for="title">Title:</label>
            <input type="text" name="title"
            class="p-2 rounded w-full"
            :class="form.errors.has('title') ? 'border-2 border-red-500' : 'border'"
            v-model="form.title"
            @keydown="form.errors.clear('title')"
            >
            <span class="text-red-500 text-sm" v-if="form.errors.has('title')" v-text="form.errors.has('title')"></span>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold" for="business_unit">Business Unit:</label>
            <select class="block p-2 border" :class="form.errors.has('business_unit') ? 'border-2 border-red-500' : 'border'" name="business_unit" id="" v-model="form.business_unit" @input="form.errors.clear('business_unit')">
                <option value="" disabled="">Select Business Unit</option>
                <option :value="unit.name" v-for="unit in businessunits">{{unit.name}}</option>
            </select>
            <span class="text-red-500 text-sm" v-if="form.errors.has('business_unit')" v-text="form.errors.has('business_unit')"></span>
        </div>  

        <div class="mb-4">
            <label class="block font-bold" for="type">Type:</label>
            <select class="block p-2 border" :class="form.errors.has('type') ? 'border-2 border-red-500' : 'border'" name="type" id="" v-model="form.type" @input="form.errors.clear('type')">
                <option value="" disabled="">Select Content Type</option>
                <option value="Work">Work</option>
                <option value="Fluff">Fluff</option>
                <option value="Other">Other</option>
            </select>
            <span class="text-red-500 text-sm" v-if="form.errors.has('type')" v-text="form.errors.has('type')"></span>
        </div>  


        <div>
            <label class="block font-bold" for="type">Publish Date:</label>
            <date-picker :default="form.publish_date" v-model='form.publish_date' @input="form.errors.clear('publish_date')"></date-picker>
            <span class="text-red-500 text-sm" v-if="form.errors.has('publish_date')" v-text="form.errors.has('publish_date')"></span>
        </div>

    </div>
    <div class="mt-8 flex items-center justify-between"> 
     <div>
        <button class="p-2 bg-blue-500 text-white rounded focus:outline-none" @click="save">Save Project</button>
        <button class="p-2 underline focus:outline-none" @click="closeModal">Cancel</button>
    </div>
    <button class="underline text-red-500" @click="deleteProject">Delete Project</button>
</div>

</div>
</modal>
</template>

<script>

    import Form from '../../form.js'
    import DatePicker from '../DatePicker.vue'

    export default {
        props:['users', 'businessunits'],
        components:{DatePicker},
        data() {
            return {
                form:new Form({
                    owner:'',
                    title:'',
                    business_unit:'',
                    type:'',
                    publish_date:''
                }),
                id:''
            }
        },
        methods: {
            beforeOpen: function(data) {

                this.form.title = data.params.form.title 
                this.form.business_unit = data.params.form.business_unit 
                this.form.owner = data.params.form.owner 
                this.form.type = data.params.form.type 
                this.form.publish_date = data.params.form.publish_date 
                this.id = data.params.form.id 
            },
            save: function() {
                this.form.patch(`/projects/${this.id}`, this.form)
            },
            deleteProject: function() {
                this.form.delete(`/projects/${this.id}`)
            },
            closeModal: function(){
                this.form.reset()
                this.$modal.hide('edit-project-modal')

            },
            fullName: function(user) {
                return `${user.first_name} ${user.last_name}`
            }
        }    
    }
</script>