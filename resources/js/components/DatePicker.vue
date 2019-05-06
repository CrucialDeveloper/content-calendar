<template>
    <div>
        <input class="p-2 border rounded w-full" type="text" id="datepicker" v-model="date">
    </div>
</template>

<script>
    import flatpickr from "flatpickr";
    import 'flatpickr/dist/flatpickr.css'

    export default {
        props:['default'],
        data() {
            return {
                date:this.default
            }
        },
        watch: {
            date: function(newValue, oldValue) {{
                this.$emit('input', this.date)
            }}
        },
        mounted() {
            let vm = this

            flatpickr("#datepicker", {
                onChange: function(date) {
                    vm.date = date
                },
                altInput: 'true',
                altFormat: 'm-d-Y',
                dafaultDate: vm.default
            });
        }
    }
</script>