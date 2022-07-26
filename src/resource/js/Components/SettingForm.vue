<template>
  <el-form
    label-width="15%"
    label-position="left"
  >
    <el-form-item
      v-for="(setting, index) in state.adminSettingFields"
      :key="`settings-${index}`"
      :label="getAdminSettingTitle(setting.key)"
    >
      <el-switch v-model="setting.value" />
    </el-form-item>
    <div class="d-flex">
      <el-button
        type="primary"
        :loading="state.loading"
        @click="handleSubmit"
      >
        Save
      </el-button>
    </div>
  </el-form>
</template>

<script>
import { defineComponent, reactive, watch } from 'vue';
import { getAdminSettingTitle } from '@/util/helper';

export default defineComponent({

  name: 'SettingForm',

  props: {
    onSubmit: Function,
    currentSettings: Object
  },
  emits: ['submit'],

  setup(props, { emit }) {

    const state = reactive({
      settingData: {},
      loading: false,
      adminSettingFields: []
    });

    const handleSubmit = async () => {

      let dataToSubmit = {};

      for (const item of state.adminSettingFields) {
        dataToSubmit[item.key] = item.value ? 1 : 0;
      }


      if (typeof props.onSubmit !== 'function') {
        return emit('submit', dataToSubmit);
      }

      state.loading = true;

      try {
        return await props.onSubmit(dataToSubmit);
      } catch (e) {
        return Promise.reject(e);
      } finally {
        state.loading = false;
      }
    };

    const populateSettingField = (settings) => {

      let updatedSettings = [];

      Object.keys(settings).forEach(key => (
        updatedSettings.push({
          key,
          value: !!settings[key]
        })
      ));

      state.adminSettingFields = updatedSettings;
    };

    watch(() => props.currentSettings, (newSettings) => {
      state.settingData = { ...newSettings };
      populateSettingField(newSettings);
    }, { immediate: true, deep: true });

    return {
      handleSubmit,
      state,
      getAdminSettingTitle
    };
  }
});
</script>

<style scoped>
.d-flex {
  display: flex;
}

.justify-content-end {
  justify-content: flex-end;
}
</style>
