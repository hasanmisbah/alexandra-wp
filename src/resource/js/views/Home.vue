<template>
  <div
    v-loading="state.loading"
    class="wrap app-container"
  >
    <el-skeleton
      v-if="!state.isLoaded"
      :rows="5"
      animated
    />
    <el-tabs
      v-else
      type="border-card"
      tab-position="left"
    >
      <el-tab-pane label="Settings">
        <SettingForm
          :current-settings="state.adminSettings"
          :on-submit="handleSettingUpdate"
        />
      </el-tab-pane>
      <el-tab-pane label="Update"/>
      <el-tab-pane label="About">
        Role
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import SettingForm from '@/Components/SettingForm';
import { getApiResponse } from '@/util/helper';
import { useNotification } from '@/composables/composable';
import { onBeforeMount, reactive } from 'vue';
import { LIST_AJAX_ACTION } from '@/util/constants';

export default {
  name: 'Home',
  components: { SettingForm },
  setup() {

    const { notifyError, notifySuccess, notify, notifyWarning } = useNotification();

    const state = reactive({
      adminSettings: {},
      loading: true,
      isLoaded: false,

    });

    const getSettings = async () => {

      state.loading = true;

      const data = { action: LIST_AJAX_ACTION.GET_ADMIN_SETTINGS };

      try {
        const response = await getApiResponse({ data });
        state.adminSettings = response.data;

      } finally {

        state.loading = false;

      }
    };

    const handleSettingUpdate = async (data) => {

      data.action = 'alexandra_update_admin_settings';

      try {

        const response = await getApiResponse({ data });
        state.adminSettings = response.data;
        notifySuccess('Setting successfully updated');

      } catch (e) {
        notifyError('Something went wrong. please try later');
      }
    };

    onBeforeMount(async () => {
      await getSettings();
      state.isLoaded = true;
    });

    return {
      handleSettingUpdate,
      notifyError,
      notifySuccess,
      notify,
      notifyWarning,
      state
    };
  }
};
</script>

<style>
.app-container {
  height: 100%;
}

.el-tabs--right .el-tabs__content,
.el-tabs--left .el-tabs__content {
  height: 100%;
}
</style>
