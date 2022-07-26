import { collection, LIST_ADMIN_SETTINGS } from '@/util/constants';

const jQuery = window.jQuery;
export const getAjaxUrl = collection?.ajax_url;

export const getApiResponse = ({ type = 'POST', data = {}, url = getAjaxUrl, options }) => {

  const requestTypes = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

  if (!requestTypes.includes(type?.toUpperCase())) {
    throw new Error(`Invalid request type: ${ type }`);
  }

  const ajaxOptions = {
    type,
    data,
    url,
    ...options,
  };

  return new Promise((resolve, reject) => {
    return jQuery
      .ajax(ajaxOptions)
      .success((response) => resolve(response))
      .error((error) => reject(error));
  });
};

export const getAdminSettingTitle = (setting) => {
  return setting in LIST_ADMIN_SETTINGS
    ? LIST_ADMIN_SETTINGS[setting]
    : setting
    ;
};

export const uid = () => {
  return Date.now().toString(36) + Math.random().toString(36).substr(2);
};

export const copyToClipboard = async (text) => {

  return new Promise((resolve, reject) => {

    // for new browsers
    if(navigator.clipboard) {
      navigator.clipboard.writeText(text);
      return resolve(true);
    }

    // for old browser
    if(document.execCommand){
      document.execCommand('copy', false, text);
      return resolve(true);
    }

    return reject(true);

  });
};
