<template>
  <el-dialog
    v-model="state.showModal"
    :title="title"
    :width="width"
    :append-to-body="appendToBody"
    :center="center"
    :show-close="!hideClose"
    :fullscreen="fullscreen"
    :destroy-on-close="destroyOnClose"
    :close-on-click-modal="closeOnClickModal"
    modal
    @close="$emit('close')"
  >
    <slot/>
    <template v-if="!hideFooter" #footer>

      <slot name="footer">

        <div class="dialog-footer">

          <el-button @click="state.showModal = false">
            {{ cancelButtonText }}
          </el-button>

          <el-button :loading="state.confirming" type="primary" @click="handleConfirm">
            {{ confirmButtonText }}
          </el-button>

        </div>

      </slot>
    </template>
  </el-dialog>
</template>

<script>
import { reactive, watch } from 'vue';

export default {
  name: 'Modal',
  props: {

    modelValue: {
      type: Boolean,
      required: true,
    },

    title: {
      type: String,
      required: true,
    },

    hideClose: {
      type: Boolean,
      default: false,
    },

    closeOnClickModal: {
      type: Boolean,
      default: false,
    },

    center: {
      type: Boolean,
      default: false,
    },

    destroyOnClose: {
      type: Boolean,
      default: true,
    },

    fullscreen: {
      type: Boolean,
      default: false,
    },

    width: {
      type: [String, Number],
      default: '40%',
    },

    hideFooter: {
      type: Boolean,
      default: false,
    },

    appendToBody: {
      type: Boolean,
      default: false,
    },

    onConfirm: {
      type: Function,
      required: false,
    },

    onCancel: {
      type: Function,
      required: false,
    },

    confirmButtonText: {
      type: String,
      default: 'OK',
    },

    cancelButtonText: {
      type: String,
      default: 'Cancel',
    },

  },
  emits: ['update:modelValue', 'onConfirm', 'onCancel', 'close'],

  setup(props, { emit }) {

    const state = reactive({
      showModal: false,
      confirming: false,
    });


    const handleConfirm = async () => {

      if (typeof props.onConfirm === 'function') {

        state.confirming = true;

        try {

          await props.onConfirm();

        } finally {

          state.confirming = false;

        }

        return;
      }

      emit('onConfirm');
      state.showModal = false;

    };

    const handleCancel = () => {

      if (typeof props.onCancel === 'function') {

        props.onCancel();
        state.showModal = false;
        return;
      }

      emit('onCancel');
      state.showModal = false;
    };

    watch(() => props.modelValue, (newValue) => {
      state.showModal = newValue;
    }, { immediate: true });

    watch(() => state.showModal, (newValue) => {
      emit('update:modelValue', newValue);
    }, { immediate: true });

    return {
      state,
      handleConfirm,
      handleCancel
    };
  }
};
</script>

<style lang="scss">
.el-dialog {

  &__header {
    border-bottom: 1px solid #e3e3e3;
    margin-right: 0;
  }

  &__footer {
    padding-top: 15px;
    border-top: 1px solid #e3e3e3;
  }
}
</style>
