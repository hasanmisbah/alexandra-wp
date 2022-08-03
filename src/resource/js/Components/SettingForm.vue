<template>
    <el-form label-width="15%" label-position="left">
        <el-form-item
            v-for="(setting, index) in state.adminSettingFields"
            :label="getAdminSettingTitle(setting.key)"
            :key="`settings-${index}`"
        >
            <el-switch v-model="setting.value"/>
        </el-form-item>
        <div class="d-flex">
            <el-button
                type="primary"
                @click="handleSubmit"
                :loading="state.loading"
            >
                Save
            </el-button>
        </div>
    </el-form>
</template>

<script>
import { defineComponent, reactive, watch } from 'vue'
import { getAdminSettingTitle } from '@/util/helper';

export default defineComponent({

    name: 'SettingForm',
    emits: ['submit'],

    props: {
        onSubmit: Function,
        currentSettings: Object
    },

    setup(props, { emit }) {

        const state = reactive({
            settingData: {},
            loading: false,
            adminSettingFields: []
        })

        const handleSubmit = async () => {

            let dataToSubmit = {};

            for (const item of state.adminSettingFields) {
                dataToSubmit[item.key] = item.value;
            }


            if (typeof props.onSubmit !== 'function') {
                return emit('submit', dataToSubmit);
            }

            state.loading = true;

            try {
                await props.onSubmit(dataToSubmit);
            } catch (e) {
                return Promise.reject(e);
            } finally {
                state.loading = false;
            }
        }

        const populateSettingField = (settings) => {

            let updatedSettings = [];

            Object.keys(settings).forEach(key => (
                updatedSettings.push({
                    key,
                    value: !!settings[key]
                })
            ));

            state.adminSettingFields = updatedSettings;
        }

        watch(() => props.currentSettings, (newSettings) => {
            state.settingData = { ...newSettings };
            populateSettingField(newSettings);
        }, { immediate: true, deep: true })

        return {
            handleSubmit,
            state,
            getAdminSettingTitle
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
