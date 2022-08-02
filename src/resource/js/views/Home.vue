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

export default {
    name: "Home",
    components: { SettingForm }
}
</script>

<style scoped>

</style>
