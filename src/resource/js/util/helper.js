import { collection, LIST_ADMIN_SETTINGS } from '@/util/constants';

export const getAjaxUrl = collection?.ajax_url;
export const getApiResponse = async (callback, { onSuccess = undefined, onError = undefined }) => {
    try {
        const response = await callback();

        if (typeof onSuccess === 'function') {
            return onSuccess(response);
        }

        return response;

    } catch (error) {

        if (typeof onError === 'function') {
            return onError(error);
        }

        return Promise.reject(error);
    }
}

export const getAdminSettingTitle = (setting, fallback = null) => {
    return setting in LIST_ADMIN_SETTINGS
        ? LIST_ADMIN_SETTINGS[setting]
        : fallback
            ? fallback
            : setting
    ;
}
