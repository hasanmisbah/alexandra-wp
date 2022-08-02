<template>
    <el-form label-width="15%" label-position="left">
        <el-form-item label="Enable Custom post type">
            <el-switch v-model="settingData.cpt"/>
        </el-form-item>
        <el-form-item label="Enable Author bio">
            <el-switch v-model="settingData.authorBio"/>
        </el-form-item>
            <div class="d-flex">
                <el-button type="primary" @click="onSubmit">Save</el-button>
            </div>
    </el-form>
</template>

<script>
import { defineComponent, reactive, watch } from 'vue'

export default defineComponent({

    name: 'SettingForm',
    emits: ['submit'],

    props: {
        onSubmit: Function,
        currentSettings: Object
    },

    setup(props, { emit }){

        const settingData = reactive({
            cpt: false,
            authorBio: false,
        })

        const handleSubmit = () => {

            if(typeof props.onSubmit !== 'function'){
                return emit('submit', settingData);

            }

            return props.onSubmit(settingData);
        }

        watch(() => props.currentSettings, (newSettings) => {
            settingData.cpt = newSettings?.cpt;
            settingData.authorBio = newSettings?.authorBio;
        }, {immediate: true, deep: true})

        return {
            handleSubmit,
            settingData
        }
    }
})
</script>

<style scoped>
.d-flex {
    display: flex;
}
.justify-content-end {
    justify-content: flex-end;
}
</style>
