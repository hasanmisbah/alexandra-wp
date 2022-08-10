<template>
  <Modal v-model="state.showModal" title="Contact Details" hide-footer>
    <table class="el-table" style="width: 100%">
      <tbody>
        <tr>
          <th>Name</th>
          <td> {{ state.contact.name }} </td>
        </tr>
        <tr>
          <th>Phone</th>
          <td>{{ state.contact.phone }}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ state.contact.email }}</td>
        </tr>
        <tr>
          <th>Notes</th>
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

<style scoped>

</style>
