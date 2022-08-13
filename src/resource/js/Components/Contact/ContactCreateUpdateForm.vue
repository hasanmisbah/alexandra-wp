<template>
  <Modal
    v-model="state.showModal"
    :title="`${state.isUpdating ? 'Update' : 'Create'} Contact`"
    :on-confirm="handleConfirm"
    :on-cancel="handleCancel"
    :confirm-button-text="`${state.isUpdating ? 'Update' : 'Create'}`"
  >

    <el-form :model="state.contact" label-width="120px" @submit="handleConfirm">

      <el-form-item label="Name" prop="name">
        <el-input v-model="state.contactForm.name" placeholder="Name"/>
      </el-form-item>

      <el-form-item label="Phone" prop="phone">
        <el-input v-model="state.contactForm.phone" placeholder="Phone"/>
      </el-form-item>

      <el-form-item label="Email" prop="email">
        <el-input v-model="state.contactForm.email" placeholder="Email"/>
      </el-form-item>

      <el-form-item label="Message" prop="message">
        <el-input v-model="state.contactForm.message" type="textarea" placeholder="Message"/>
      </el-form-item>

    </el-form>
  </Modal>
</template>

<script>
import { reactive, watch } from 'vue';
import { isEmpty } from 'lodash';
import Modal from '@/Components/Modal';

export default {
  name: 'ContactCreateUpdateForm',
  components: { Modal },
  props: {

    modelValue: {
      type: Boolean,
      default: false,
    },

    contact: {
      type: Object,

      default: () => ({
        name: '',
        phone: '',
        email: '',
        message: '',
      }),
    },

    onConfirm: {
      type: Function,
      default: () => {
      },
    },

    onCancel: {
      type: Function,
      default: () => {
      },
    },
  },

  emits: ['update:modelValue', 'cancel', 'onConfirm'],

  setup(props, { emit }) {

    const state = reactive({

      showModal: false,
      isUpdating: false,
      formSubmitting: false,

      contactForm: {
        name: '',
        phone: '',
        email: '',
        message: '',
      }
    });

    const handleConfirm = () => {

      const dataToSubmit = { ...state.contactForm };

      state.formSubmitting = true;

      if (typeof props.onConfirm === 'function') {

        try {
          props.onConfirm(dataToSubmit, state.isUpdating);
        } finally {
          state.formSubmitting = true;
        }

        return;
      }

      emit('onConfirm', dataToSubmit);
      state.showModal = false;
    };

    const handleCancel = () => {

      if (typeof props.onCancel === 'function') {
        props.onCancel();
        return;
      }

      emit('cancel', false);
      state.showModal = false;
    };


    function populateContactForm(contact) {

      if (isEmpty(contact)) {
        state.contactForm = {
          name: '',
          phone: '',
          email: '',
          message: '',
        };

        state.isUpdating = false;

        return;
      }

      state.isUpdating = true;

      state.contactForm = {
        id: contact?.id,
        name: contact.name,
        phone: contact.phone,
        email: contact.email,
        message: contact.message,
      };
    }

    watch(() => props.modelValue, (value) => state.showModal = value, { immediate: true });

    watch(() => state.showModal, (value) => emit('update:modelValue', value), { immediate: true });

    watch(() => props.contact, (value) => populateContactForm(value));

    return {
      state,
      handleConfirm,
      handleCancel
    };
  },
};
</script>

<style scoped lang="scss">
::v-deep(.el-input__inner) {
  border-color: transparent !important;
  padding: 0 !important;

  &:focus {
    outline-color: transparent;
    border-color: transparent;
    box-shadow: none;
  }
}
</style>
