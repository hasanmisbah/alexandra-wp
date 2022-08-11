<template>
  <div>
    <div class="d-flex header-content">
      <h1>Contact</h1>
      <div class="header-right">
        <el-button type="primary" @click="handleCreate">Create</el-button>
      </div>
    </div>
    <DataTable :columns="state.columns" :data="state.data" show-index paginate>
      <template #action="{ data }">
        <el-button type="primary" :icon="View" circle @click="handleContactSelect(data, 'view')"/>
        <el-button type="primary" :icon="Edit" circle @click="handleContactSelect(data, 'edit')"/>
        <el-button type="danger" :icon="Delete" circle @click="handleContactSelect(data, 'delete')"/>
      </template>
    </DataTable>
  </div>

  <ContactDetails
    v-model="state.showContactDetails"
    :contact="state.selectedContact"
  />

  <ContactCreateUpdateForm
    v-model="state.sowAddUpdateModal"
    :contact="state.selectedContact"
  />

</template>

<script>
import { onBeforeMount, reactive } from 'vue';
import { contacts } from '@/util/_mocks';
import DataTable from '@/Components/DataTable';

import { Delete, Edit, View } from '@element-plus/icons-vue';
import { useConfirm, useNotification } from '@/composables/composable';
import ContactDetails from '@/Components/Contact/ContactDetails';
import ContactCreateUpdateForm from '@/Components/Contact/ContactCreateUpdateForm';
import { LIST_AJAX_ACTION } from '@/util/constants';
import { getApiResponse } from '@/util/helper';

export default {
  name: 'Contact',
  components: { ContactCreateUpdateForm, ContactDetails, DataTable },
  setup() {

    const { confirm } = useConfirm();
    const { notifySuccess, notifyError } = useNotification();

    const state = reactive({
      loading: true,
      isLoaded: false,
      sowAddUpdateModal: false,
      data: [],
      selectedContact: {},
      showContactDetails: false,
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

    const handleContactSelect = (contact, action = 'view') => {

      if (action === 'delete') {
        return onDelete(contact);
      }

      state.selectedContact = contact;

      if (action === 'view') {
        state.showContactDetails = true;
        return;
      }

      if (action === 'edit') {
        state.sowAddUpdateModal = true;
      }

    };

    const handleCreate = () => {
      state.selectedContact = {};
      state.sowAddUpdateModal = true;
    };

    // all function defined with function keyword will run only inside the `setup` scope
    // this will not be used in the `render` scope

    function handleDeleteContact(id) {

      try {

        state.data = state.data.filter(contact => contact.id !== id);

        notifySuccess('Contact has been deleted');

      } catch (e) {

        notifyError('Contact has not been deleted');

      }

    }

    function onDelete(contact) {

      confirm({

        onConfirm: () => handleDeleteContact(contact?.id),

      });
    }

    function loadContacts(){
      const data = {
        action: LIST_AJAX_ACTION.GET_ALL_CONTACTS
      };

      const response = getApiResponse({ data });
      console.log(response);
    }

    // this will run on lifecycle hook 'onBeforeMount'
    async function beforeMount() {
      await loadContacts();
      state.data = [...contacts(45)];
    }

    onBeforeMount(() => beforeMount());

    return {
      state,
      Delete,
      Edit,
      View,
      handleContactSelect,
      handleCreate
    };
  }
};
</script>

<style scoped>
.el-input__inner {
  border-color: transparent !important;
}

.d-flex {
  display: flex;
}

.header-content {
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin: 15px 0;
}
</style>
