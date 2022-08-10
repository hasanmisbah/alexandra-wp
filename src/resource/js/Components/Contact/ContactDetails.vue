<template>
  <Modal v-model="state.showModal" title="Contact Details" hide-footer>
    <table class="contact-table" style="width: 100%">
      <tbody>
        <tr>
          <th scope="row">
            Name
          </th>
          <td> {{ state.contact.name }}</td>
        </tr>
        <tr>
          <th scope="row">
            Phone
          </th>
          <td>{{ state.contact.phone }}</td>
        </tr>
        <tr>
          <th scope="row">
            Email
          </th>
          <td>{{ state.contact.email }}</td>
        </tr>
        <tr>
          <th scope="row">
            Message
          </th>
          <td>{{ state.contact.message }}</td>
        </tr>
      </tbody>
    </table>
  </Modal>
</template>

<script>
import Modal from '@/Components/Modal';
import { reactive, watch } from 'vue';

export default {
  name: 'ContactDetails',
  components: { Modal },

  props: {

    modelValue: {
      type: Boolean,
      default: false,
    },

    contact: {
      type: [Object, null],

      default: () => ({
        name: '',
        phone: '',
        email: '',
        message: ''
      })

    },
  },

  emits: ['update:modelValue'],

  setup(props, { emit }) {

    const state = reactive({

      showModal: false,
      contact: {
        name: '',
        phone: '',
        email: '',
        message: '',
      },

    });

    watch(() => props.modelValue, (value) => {

      if (!value) {
        state.contact = { ...props.contact };
      }

      state.showModal = value;
    });

    watch(() => props.contact, (value) => {
      state.contact = { ...value };
    });

    watch(() => state.showModal, (value) => {
      emit('update:modelValue', value);
    });

    return {
      state
    };
  },
};
</script>

<style scoped lang="scss">

.contact-table {
  display: table;

  tr {
    display: table-row;
    width: 100%;

    th, td {
      display: table-cell;
      padding: 0.5rem;
      text-align: left;
      vertical-align: middle;
      width: auto;
    }

    th {
      width: 15%;
    }

    td {
      width: 75%;
      border-bottom: 1px solid #e3e3e3;
    }
  }

}
</style>
