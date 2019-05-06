<template>
   <div>
    <label class="block" for="name">Color:</label>
    <div class="block">
        <chrome-picker v-model=color></chrome-picker>
    </div>
</div>
</template>

<script>
    import {Chrome} from 'vue-color'
    export default {
        props:{
            default: {
                default:'#d3d3d3'
            }
        },
        components:{
            'chrome-picker': Chrome
        },
        data() {
            return {
                color: this.default
            }
        },
        watch: {
            color: {
                handler: function(newValue, oldValue) {
                    this.$emit('input', newValue.hex)
                },
            },

        },
    }
</script>

<style scoped="">
.vc-material {
    height:auto;
}

</style>
