<template>
    <div>

        <div class="mb-4">
           <div class="flex items-center justify-between">
               <h2 class="text-xl underline mr-4">Business Units</h2>
               <button class="h-10 w-10 text-blue-500 fill-current focus:outline-none" @click="openCreateModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z"/></svg>
            </button>
        </div> 
        <div class="flex items-center flex-wrap">
            <button class="flex items-center mx-4 p-2 rounded focus:outline-none" :class="unit.name === filter ? 'bg-gray-500' : ''" v-for="unit in businessunits" @click="setFilter(unit.name)">
                <span class="mr-2" v-text="unit.name"></span>
                <span class="w-8 h-4 rounded" :style="{background:unit.color}"></span>
            </button>                
        </div>
    </div>

    <div class="bg-white shadow-lg rounded p-4">
        <FullCalendar
        :plugins="calendarPlugins"
        :weekends=false
        :header="{left:'title', center: '', right:'today prev,next'}"
        :displayEventTime=false
        :events="events"
        :showNonCurrentDates=false
        :editable=true
        @eventClick="openEvent($event)"
        />
    </div>
    <create-project-modal :businessunits=businessunits :users=users></create-project-modal>
    <edit-project-modal :businessunits=businessunits :users=users></edit-project-modal>
</div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import '@fullcalendar/core/main.css';
    import '@fullcalendar/daygrid/main.css';
    import CreateProjectModal from '../projects/CreateProjectModal.vue' 
    import EditProjectModal from '../projects/EditProjectModal.vue'

    export default {
        props: ['projects', 'businessunits', 'users'],
        components: {FullCalendar, CreateProjectModal, EditProjectModal},
        data() {
            return {
                calendarPlugins: [ dayGridPlugin ],
                filter:''
            }
        },
        methods:  {
            getColor: function(project) {
                return this.businessunits.filter(function(unit) {
                    if (project.business_unit === unit.name) {
                        return unit.color
                    }
                })[0].color
            },
            openEvent: function (e) {
                let form = this.projects.filter(function(unit) {
                    return unit.title === e.event.title
                })[0]

                this.$modal.show('edit-project-modal', {form})
            },
            setFilter: function(name) {
                if(this.filter === name) {
                    this.filter= ''
                } else {
                    this.filter = name
                }
            },
            openCreateModal: function() {
               this.$modal.show('create-project-modal') 
           }
       },
       computed: {
        events: function() {
            let vm = this
            let items = this.projects 
            if(this.filter) {
                items = this.projects.filter(function(project) {
                    return project.business_unit === vm.filter
                })
            }

            return items.map(function(project) {
                return {
                    title:project.title,
                    date:project.publish_date, 
                    color:vm.getColor(project)
                }
            })
        }
    }
}
</script>