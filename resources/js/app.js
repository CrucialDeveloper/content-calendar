/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 import VModal from 'vue-js-modal'
 Vue.use(VModal)

 import BusinessConfig from './components/config/BusinessConfig.vue'
 import ContentCalendar from './components/calendar/ContentCalendar.vue'
 import ContentProjects from './components/projects/ContentProjects.vue'
import ContentReports from './components/reports/ContentReports.vue'

 const app = new Vue({
    el: '#app',
    components:{BusinessConfig, ContentCalendar, ContentProjects, ContentReports}
});
