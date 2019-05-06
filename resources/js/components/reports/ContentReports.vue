<template>
    <projects-time :projects=projects></projects-time>
</template>

<script>
    import ProjectsTime from '../reports/ProjectsTime.vue'

    export default {
        props:['projects'],
        components:{ProjectsTime},
        data() {
            return {

            }
        }
    }
</script>