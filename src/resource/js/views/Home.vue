<template>
    <div class="wrap">
        <el-tabs type="border-card">
            <el-tab-pane label="Settings">
                <SettingForm :onSubmit="handleSettingUpdate"/>
            </el-tab-pane>
            <el-tab-pane label="Update">Config</el-tab-pane>
            <el-tab-pane label="About">Role</el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import SettingForm from '@/Components/SettingForm';
import { getAjaxUrl } from '@/util/helper'
import jQuery from 'jquery'

export default {
    name: 'Home',
    components: { SettingForm },
    setup() {
        const handleSettingUpdate = async () => {
            await jQuery.post(getAjaxUrl, {action: 'alex_ajax_action'}, function (data) {
                console.log(data);
            }).fail(function (e) {
                console.log(e);
            });
        }

        return {
            handleSettingUpdate
        }
    }
}
</script>

<style scoped>

</style>
