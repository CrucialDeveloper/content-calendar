<script>
    import { Line } from 'vue-chartjs'

    export default {
      extends: Line,
      props: ['projects'],
      data() {
        return {
            chartdata:[this.projects],
            options:[]
        }
    },
    mounted () {
        this.renderChart(this.chartdata, this.options)
    }
}
</script>