import { ElLoading, ElMessage } from 'element-plus';
import { getCurrentInstance } from 'vue';

const appInstance = getCurrentInstance();

export function useLoading(options) {

  let loader = null;

  const config = {
    lock: true,
    text: 'Loading...',
    background: 'rgba(255, 255, 255, 0.9)',
    target: '#alexandra-container',
    ...options
  };

  const startLoading = () => {

    if (loader) return;

    loader = ElLoading.service({
      ...config
    });
  };

  const stopLoading = () => {

    if (!loader) return;

    loader.close();

    loader = null;
  };

  return {
    startLoading,
    stopLoading
  };

}

export function useNotification(options) {

  const config = {
    duration: 3000,
    showClose: true,
    customClass: 'alexandra-notification',
    ...options
  };

  const notify = (message, options) => {

    ElMessage({
      ...config,
      ...options,
      message,
    }, appInstance);

  };

  const notifyError = (message, options) => {

    notify(message, {
      ...options,
      type: 'error',
    });

  };

  const notifySuccess = (message, options) => {

    notify(message, {
      ...options,
      type: 'success',
    });


  };

  const notifyWarning = (message, options) => {

    notify(message, {
      ...options,
      type: 'warning',
    });

  };

  return {
    notify,
    notifyError,
    notifySuccess,
    notifyWarning,
  };
}
