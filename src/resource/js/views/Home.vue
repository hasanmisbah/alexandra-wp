<template>
    <div class="wrap">
        <el-tabs type="border-card">
            <el-tab-pane label="Settings">
                <SettingForm :onSubmit="handleSettingUpdate"/>
            </el-tab-pane>
            <el-tab-pane label="Update">
                <div>
                    <el-button type="primary" @click="notify('Hello')"> Simple</el-button>
                    <el-button type="primary" @click="notifyWarning('Hello')"> Warning</el-button>
                    <el-button type="primary" @click="notifySuccess('Hello')"> Success</el-button>
                    <el-button type="primary" @click="notifyError('Hello')"> Error</el-button>
                </div>
            </el-tab-pane>
            <el-tab-pane label="About">Role</el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import SettingForm from '@/Components/SettingForm';
import { getAjaxUrl } from '@/util/helper'
import jQuery from 'jquery'
import { useLoading, useNotification } from '@/composables/composable';
import { onMounted } from 'vue';

export default {
    name: 'Home',
    components: { SettingForm },
    setup() {
        const { startLoading, stopLoading } = useLoading();

        const { notifyError, notifySuccess, notify, notifyWarning } = useNotification();

        const handleSettingUpdate = async () => {
            await jQuery.post(getAjaxUrl, { action: 'alex_ajax_action' }, function (data) {
                console.log(data);
            }).fail(function (e) {
                console.log(e);
            });
        }

        onMounted(() => {
            startLoading();

            setTimeout(() => {
                stopLoading();
            }, 5000);
        })

        return {
            handleSettingUpdate,
            notifyError,
            notifySuccess,
            notify,
            notifyWarning
        }
    }
}
</script>

<style scoped>

</style>
