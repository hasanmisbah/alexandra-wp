<template>
    {{ message }}
</template>

<script>
import { defineComponent, onMounted } from 'vue'

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
