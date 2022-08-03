import { ElLoading, ElMessage } from 'element-plus'

export function useLoading(...options) {

    let loader = null;

    const config = {
        lock: true,
        text: 'Loading...',
        background: 'rgba(255, 255, 255, 0.9)',
        target: '#alexandra-container',
        ...options
    }

    const startLoading = () => {

        if (loader) return;

        loader = ElLoading.service(config);
    }

    const stopLoading = () => {

        if(!loader) return;

        loader.close();

        loader = null;
    }

    return {
        startLoading,
        stopLoading
    }

}

export function useNotification(...options) {

    const config = {
        duration: 3000,
        showClose: true,
        grouping: true,
        customClass: 'alexandra-notification',
        ...options
    }

    const notify = (message, ...options) => {

        ElMessage({
            ...config,
            ...options,
            message,
        });

    }

    const notifyError = (message, ...options) => {

        ElMessage({
            ...config,
            ...options,
            type: 'error',
            message,
        });

    }

    const notifySuccess = (message, ...options) => {

        ElMessage({
            ...config,
            ...options,
            type: 'success',
            message,
        });

    }

    const notifyWarning = (message, ...options) => {

        ElMessage({
            ...config,
            ...options,
            type: 'warning',
            message,
        });

    }

    return {
        notify,
        notifyError,
        notifySuccess,
        notifyWarning,
    }
}
