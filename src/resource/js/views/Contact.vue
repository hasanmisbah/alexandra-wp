<template>
  <div>
    <h1>Contact</h1>
    <DataTable :columns="state.columns" :data="state.data" show-index paginate>
      <template #action="{ data }">
        <el-button type="primary" :icon="View" circle/>
        <el-button type="primary" :icon="Edit" circle @click="state.sowAddUpdateModal = true"/>
        <el-button type="danger" :icon="Delete" circle @click="onDelete(data)"/>
      </template>
    </DataTable>
  </div>
  <Modal v-model="state.sowAddUpdateModal" title="Test Modal">
    <h1>Hello World</h1>
  </Modal>
</template>

<script>
import { onBeforeMount, reactive } from 'vue';
import { contacts } from '@/util/_mocks';
import DataTable from '@/Components/DataTable';

import { Delete, Edit, View } from '@element-plus/icons-vue';
import { useConfirm, useNotification } from '@/composables/composable';
import Modal from '@/Components/Modal';

export default {
  name: 'Contact',
  components: { Modal, DataTable },
  setup() {

    const { confirm } = useConfirm();
    const { notifySuccess, notifyError } = useNotification();

    const state = reactive({
      loading: true,
      isLoaded: false,
      sowAddUpdateModal: false,
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
        },
        {
          key: 'action',
          label: 'Action'
        }
      ]
    });



    const onDelete = (contact) => {

      confirm({

        onConfirm: () => handleDeleteContact(contact?.id),

      });
    };

    const handleDeleteContact = (id) => {

      try {

        state.data = state.data.filter(contact => contact.id !== id);

        notifySuccess('Contact has been deleted');

      } catch (e) {

        notifyError('Contact has not been deleted');

      }

    };

    function beforeMount() {
      state.data = [...contacts(45)];
    }

    onBeforeMount(() => beforeMount());

    return {
      state,
      Delete,
      Edit,
      View,
      onDelete
    };
  }
};
</script>

<style scoped>

</style>
