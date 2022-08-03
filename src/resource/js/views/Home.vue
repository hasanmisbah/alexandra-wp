<template>
    <div class="wrap" v-loading="state.loading">
        <el-tabs type="border-card">
            <el-tab-pane label="Settings">
                <SettingForm
                    :current-settings="state.adminSettings"
                    :onSubmit="handleSettingUpdate"
                />
            </el-tab-pane>
            <el-tab-pane label="Update"></el-tab-pane>
            <el-tab-pane label="About">Role</el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import SettingForm from '@/Components/SettingForm';
import { getAjaxUrl } from '@/util/helper'
import jQuery from 'jquery'
import { useNotification } from '@/composables/composable';
import { onMounted, reactive } from 'vue';
import { LIST_ADMIN_SETTINGS, LIST_AJAX_ACTION } from '@/util/constants';

export default {
    name: 'Home',
    components: { SettingForm },
    setup() {

        const { notifyError, notifySuccess, notify, notifyWarning } = useNotification();

        const state = reactive({
            adminSettings: {
                chat_settings: 0,
                cpt_settings: 0,
                gallery_settings: 0,
                login_settings: 0,
                membership_settings: 0,
                taxonomy_settings: 0,
                template_settings: 0,
                testimonial_settings: 0,
                widget_settings: 0,
            },
            loading: false
        })

        const getSettings = async ()=> {

            state.loading = true;

            const data = { action: LIST_AJAX_ACTION.GET_ADMIN_SETTINGS };

            try{
                const response = await jQuery.post(getAjaxUrl, data);
                state.adminSettings = response.data;
            }finally {
                state.loading = false;
            }
        }

        onMounted(()=> {
            getSettings();
        });

        const handleSettingUpdate = async (data) => {
            // await jQuery.post(getAjaxUrl, { action: 'alexandra_get_admin_settings' }, function (data) {
            //     console.log(data);
            // }).fail(function (e) {
            //     console.log(e);
            // });
        }

        return {
            handleSettingUpdate,
            notifyError,
            notifySuccess,
            notify,
            notifyWarning,
            state
        }
    }
}
</script>

<style scoped>

</style>
