<template>
    <div class="bg-white rounded shadow-lg p-8 mx-auto w-1/2">
        <div class="flex items-center justify-between ">
            <h2 class="text-xl font-bold">Business Units</h2>
            <button class="text-blue-500 fill-current h-8 w-8" @click="openCreateModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z"/></svg>
            </button>
        </div>
        <div class="flex items-center mt-4" v-for="business in ordered">
            <span class="mr-2 w-64 text-right">
                {{business.name}} 
            </span>
            <div class="w-16 h-4 my-2 rounded mr-4" :style="{background:business.color}"></div>
            <button class="text-gray-600 fill-current h-4 w-4" @click="edit(business)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
            </button>
        </div>
        <business-create-modal></business-create-modal>
        <business-update-modal></business-update-modal>
    </div>
</template>

<script>

    import Form from '../../form.js'
    import BusinessCreateModal from '../config/BusinessCreateModal.vue'
    import BusinessUpdateModal from '../config/BusinessUpdateModal.vue'



    export default {
        props:['businesses'],
        components:{BusinessCreateModal, BusinessUpdateModal},
        methods: {
            openCreateModal: function() {
                this.$modal.show('business-create-modal')
            },
            edit: function(business) {
                this.$modal.show('business-update-modal', {business})
            }
        },
        computed: {
            ordered: function() {
                return _.orderBy(this.businesses,'name')
            }
        }    
    }
</script>

