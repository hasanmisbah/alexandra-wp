<template>
  <div id="alexandra-container">
    <RouterView />
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'App',
});
</script>

<style>
.el-message {
  z-index: 99999999999999 !important;
}
.alexandra-notification {
  z-index: 99999999999999 !important;
}
</style>
