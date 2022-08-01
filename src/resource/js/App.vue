<template>
    {{ message }}
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'App',
    setup() {

        return {
            message: 'Hello Vue!'
        }
    }
})
</script>

<style scoped>

</style>
