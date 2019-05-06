<template>
  <div class="text-sm">
    <div class="mb-4 flex items-center justify-between">
      <div class="mr-8">
        <label class="font-bold text-gray-900">
          Items Per Page:
        </label>
        <select class="p-2 border bg-gray-300" v-model="perPage" @change="currentPage=1">
          <option :value=5>5</option>
          <option :value=10>10</option>
          <option :value=25>25</option>
          <option :value=50>50</option>
          <option :value=100>100</option>
        </select>
      </div>
      <div class="flex items-center">
        <div class="border-2 p-2 flex items-center rounded w-64 mr-4">
          <span class="text-gray-900 fill-current h-4 w-4 font-bold mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
          </span>
          <input class="text-gray-900 w-full focus:outline-none" type="text" v-model="search" placeholder="Search ...">
          <button class="text-gray-900 fill-current h-4 w-4 focus:outline-none" @click="search = ''">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
          </button>
        </div>
        <div>
          <data-export :data="exportData" name="ContentCalender.csv">
            <button class="bg-gray-300 p-2 rounded flex items-center">
              <div class="h-4 w-4 text-gray-900 fill-current mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
              </div>
              <span>Export</span>
            </button>

          </data-export>
        </div>
      </div>
    </div>

    <table class="text-gray-900 w-full shadow-md mb-4">
      <tr>
        <th class="py-2 px-4 bg-gray-300 font-sans font-medium uppercase text-sm text-gray-900 border border-gray-500"></th>
        <th class="py-2 px-4 bg-gray-300 font-sans font-medium uppercase text-sm text-gray-900 border border-gray-500" :key=key v-for="key in keys">
          <span class="flex items-center justify-between">
            <span class="mr-4">
              {{ getHeader(key) }}
            </span>
            <span class="flex items-center justify-between">
              <button class="mr-2 h-4 w-4 text-gray-900 fill-current" @click="sort(key, 'asc')" :class="sortBy.hasOwnProperty(key) && sortBy[key]==='asc' ? 'text-blue-500' : ''">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
              </button>
              <button class="mr-2 h-4 w-4 text-gray-900 fill-current" @click="sort(key, 'desc')" :class="sortBy.hasOwnProperty(key) && sortBy[key]==='desc' ? 'text-blue-500' : ''">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </button>
            </span>
          </span>
        </th>
      </tr>
      <tbody>
        <tr class="hover:bg-gray-300" :key="index" v-for="(form,index) in displayItems">
          <td class="border border-gray-500 align-center text-center cursor-pointer" @click="editModal(form)">
            <button class='h-4 w-4 text-sm text-gray-900 focus:outline-none text-center'>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
            </button>
          </td>
          <td class="py-2 px-4 border border-gray-500 align-top" v-for="key in keys" :key="key">
            {{key !='publish_date' ? form[key] : lastUpdatedCalendar(form[key])}}
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex items-center" v-if="allPages.length>1">
      <div class="flex items-center mt-4">
        <button class="rounded border text-sm text-gray-700 no-underline mr-2 hover:bg-gray-300 px-2 h-8 flex items-center justify-center" :class="currentPage === 1 ? 'bg-gray-300 cursor-not-allowed':''" @click.stop="currentPage=1" :disabled="currentPage === 1">First</button>
      </div>
      <div class="flex items-center mt-4">
        <button class="rounded border text-sm text-gray-700 no-underline mr-2 hover:bg-gray-300 px-2 h-8 flex items-center justify-center" :class="currentPage === 1 ? 'bg-gray-300 cursor-not-allowed':''" @click.stop="currentPage--" :disabled="currentPage ===1">Prev</button>
      </div>
      <div class="flex items-center mt-4">
        <button class="rounded border text-sm text-gray-700 no-underline mr-2 h-8 w-8 flex items-center justify-center" :class="currentPage === page ? 'bg-blue text-white cursor-not-allowed':''" v-for="page in allPages" :disabled="currentPage === page" @click.stop="currentPage=page">{{page}}</button>
      </div>
      <div class="flex items-center mt-4">
        <button class="rounded border text-sm text-gray-700 no-underline mr-2 hover:bg-gray-300 px-2 h-8 flex items-center justify-center" :class="currentPage === pages ? 'bg-gray-300 cursor-not-allowed':''" @click.stop="currentPage++" :disabled="currentPage === pages">Next</button>
      </div>
      <div class="flex items-center mt-4">
        <button class="rounded border text-sm text-gray-700 no-underline mr-2 hover:bg-gray-300 px-2 h-8 flex items-center justify-center" :class="currentPage === pages ? 'bg-gray-300 cursor-not-allowed':''" @click.stop="currentPage=pages" :disabled="currentPage === pages">Last</button>
      </div>
    </div>
  </div>
</template>

<script>

  import moment from 'moment'
  import DataExport from 'vue-json-csv'

  export default {
    props:['keys', 'form-data', 'forms'],
    components: {DataExport},
    data() {
      return {
        perPage:5,
        items: this.forms,
        currentPage: 1,
        sortBy:{},
        search:'',
        exportData:[this.formdata]
      }
    },
    computed: {
      pages: function() {
        return Math.ceil(this.items.length / this.perPage)
      },

      displayItems: function() {
        let vm =this

        let searched = vm.items
        if (vm.search) {
          searched = searched.filter(function(item){
            return Object.keys(item).some(function(key) {
              return Object.values(item).some(function(value){
                return value.toString().toLowerCase().includes(vm.search.toLowerCase())
              })
            })
          })
        }

        let sorted = null

        if(Object.keys(this.sortBy).length > 0) {
          sorted = _.orderBy(searched, _.keys(vm.sortBy), _.values(vm.sortBy))
        } else {
          sorted = searched
        }

        this.exportData = sorted

        return sorted.filter(function(item, index){
          return index>= vm.currentPage * vm.perPage - vm.perPage && index<=vm.perPage *vm.currentPage -1
        })

      },
      allPages: function() {
        let vm =this
        let numbers= _.range(1,vm.items.length/vm.perPage +1)
        return numbers.filter(function(number){
          return number >=vm.currentPage -3 && number <=vm.currentPage +3
        })
      },
    },
    methods: {
      sort: function(key, order) {
        if(key in this.sortBy && this.sortBy[key] === order ){
          Vue.delete(this.sortBy, key)
        } else {
          Vue.set(this.sortBy, key, order)
        }
      },
      getHeader: function(key) {
        return _.startCase(key)
      },
      lastUpdatedHuman: function(date) {
        return moment.parseZone(date).fromNow()
      },
      lastUpdatedCalendar: function(date) {
        return moment(date).format('MM-DD-Y')
      },
      editModal: function(form){
        this.$modal.show('edit-project-modal', {form})
      }
    },
  }

</script>