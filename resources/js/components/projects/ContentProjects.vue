<template>
    <div class="bg-white shadow-lg rounded p-8">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <h2 class="text-2xl mr-2">Content Projects</h2>
                <span>({{projects.length}})</span>
            </div>
            <button class="h-10 w-10 text-blue-500 fill-current focus:outline-none" @click="openModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z"/></svg>
            </button>
        </div>

        <table-filter :forms="projects" :keys="['title', 'owner','business_unit','type','publish_date']"></table-filter>
        <create-project-modal :businessunits=businessunits :users=users></create-project-modal>
        <edit-project-modal :businessunits=businessunits :users=users></edit-project-modal>
    </div>
</template>

<script>

    import TableFilter from '../TableFilter.vue'
    import CreateProjectModal from './CreateProjectModal.vue' 
    import EditProjectModal from './EditProjectModal.vue'

    export default {
        props:['projects', 'businessunits','users'],
        components:{TableFilter, CreateProjectModal, EditProjectModal},
        data() {
            return {

            }
        },    
        methods: {
            openModal: function() {
                this.$modal.show('create-project-modal') 
            }
        }
    }
</script>