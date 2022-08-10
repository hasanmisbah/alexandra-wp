import { ElLoading, ElMessage, ElMessageBox } from 'element-plus';
import { getCurrentInstance, reactive } from 'vue';

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

export function useConfirm(options) {

  const config = {
    confirmButtonText: 'OK',
    cancelButtonText: 'Cancel',
    type: 'warning',
    ...options,
  };

  /**
   *
   * @param message <String> - The message to display in the confirm dialog.
   * @param title <String> - Optional
   * @param onConfirm <Function>
   * @param onCancel <Function>
   * @param options <Object>
   */
  const confirm = ({
                     message = 'Are you sure! you want to delete?',
                     title = 'Warning!',
                     onConfirm = (e) => e,
                     onCancel = (c) => c,
                     options = {},
                   }) => {

    const notificationConfig = {
      ...config,
      ...options
    };

    ElMessageBox.confirm(message, title, notificationConfig)
      .then((value) => {

        if (typeof onConfirm === 'function') {
          onConfirm(value);
        }

      })
      .catch((error) => {

        if (typeof onCancel === 'function') {
          onCancel(error);
        }

      });
  }
  ;

  return {
    confirm,
  };
}

export function appState() {

  const state = reactive({
    loading: false,
    errors: [],
    errorMessage: '',
  });

  return {
    state,
  };
}
