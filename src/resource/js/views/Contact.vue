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
    :copy-handler="handleCopyToClipboard"
  />

  <ContactCreateUpdateForm
    v-model="state.sowAddUpdateModal"
    :contact="state.selectedContact"
    :on-confirm="handleContactCreateUpdate"
  />

</template>

<script>
import { onBeforeMount, reactive } from 'vue';
import DataTable from '@/Components/DataTable';

import { Delete, Edit, View } from '@element-plus/icons-vue';
import { useConfirm, useNotification } from '@/composables/composable';
import ContactDetails from '@/Components/Contact/ContactDetails';
import ContactCreateUpdateForm from '@/Components/Contact/ContactCreateUpdateForm';
import { LIST_AJAX_ACTION } from '@/util/constants';
import { copyToClipboard, getApiResponse } from '@/util/helper';

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
          key: 'message',
          label: 'Notes'
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

    const handleContactCreateUpdate = (data, isUpdating) => {

      if (!isUpdating) {
        return createContact(data);
      }

      return handleUpdateContact(data);

    };

    const handleCreate = () => {
      state.selectedContact = {};
      state.sowAddUpdateModal = true;
    };

    const handleCopyToClipboard = async (value)=> {

      try {

        await copyToClipboard(value);
        notifySuccess('Copied to clipboard');

      }catch (e) {

        notifyError('Failed to copy to clipboard');

      }
    };

    // all function defined with function keyword will run only inside the `setup` scope
    // this will not be used in the `render` scope

    async function createContact(contact) {

      const data = {
        action: LIST_AJAX_ACTION.CREATE_NEW_CONTACT,
        ...contact
      };

      try {
        const response = await getApiResponse({ data });

        state.sowAddUpdateModal = false;
        state.data.push(response);
        notifySuccess('Contact created successfully');

      } catch (e) {

        notifyError('Something went wrong');

      }

    }

    async function handleDeleteContact(id) {

      const data = {
        action: LIST_AJAX_ACTION.DELETE_CONTACT,
        id: id
      };

      try {

        const response = await getApiResponse({ data });
        state.data = state.data.filter(contact => contact.id !== response.id);
        notifySuccess('Contact has been deleted');

      } catch (e) {

        notifyError('Contact has not been deleted');

      }

    }

    async function handleUpdateContact(contact) {

      const data = {
        action: LIST_AJAX_ACTION.UPDATE_CONTACT,
        ...contact
      };

      try {

        const response = await getApiResponse({ data });
        state.data = state.data.map(contact => (contact.id === response.id ? response : contact));
        state.sowAddUpdateModal = false;
        notifySuccess('Contact has been updated');

      } catch (e) {

        notifyError('Contact has not been updated');

      }
    }

    function onDelete(contact) {

      confirm({

        onConfirm: () => handleDeleteContact(contact?.id),

      });
    }

    async function loadContacts() {
      const data = {
        action: LIST_AJAX_ACTION.GET_ALL_CONTACTS,
      };

      const response = await getApiResponse({ data });
      state.data = [...response];
    }

    // this will run on lifecycle hook 'onBeforeMount'
    async function beforeMount() {
      await loadContacts();
    }

    onBeforeMount(() => beforeMount());

    return {
      state,
      Delete,
      Edit,
      View,
      handleContactSelect,
      handleCreate,
      handleContactCreateUpdate,
      handleCopyToClipboard
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
