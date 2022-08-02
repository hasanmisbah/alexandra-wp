<template>
    <div class="wrap">
        <el-tabs type="border-card">
            <el-tab-pane label="Settings">
                <SettingForm/>
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
import { onMounted } from 'vue';
export default {
    name: 'Home',
    components: { SettingForm },
    setup(){
        onMounted(async ()=> {
            await jQuery.post(getAjaxUrl, {action: 'alex_ajax_action'}, function (data) {
                console.log(data);
            }).fail(function (e) {
                console.log(e);
            });
        });
    }
}
</script>

<style scoped>

</style>
