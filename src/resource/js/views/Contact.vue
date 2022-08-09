<template>
  <div>
    <h1>Contact</h1>
    <DataTable :columns="state.columns" :data="state.data" show-index />
  </div>
</template>

<script>
import { onBeforeMount, reactive } from 'vue';
import { contacts } from '@/util/_mocks';
import DataTable from '@/Components/DataTable';

export default {
  name: 'Contact',
  components: { DataTable },
  setup() {

    const state = reactive({
      loading: true,
      isLoaded: false,
      data: [],
      columns: [
        {
          key: 'name',
          label: 'Name'
        },
        {
          key: 'phone',
          label: 'Phone'
        },
        {
          key: 'email',
          label: 'Email'
        }
      ]
    });

    onBeforeMount(()=> {
      state.data = contacts(45);
    });

    return {
      state
    };
  }
};
</script>

<style scoped>

</style>
