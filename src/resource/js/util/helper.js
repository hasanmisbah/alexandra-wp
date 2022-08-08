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
    jQuery
      .ajax(ajaxOptions)
      .success((response) => resolve(response))
      .fail((error) => reject(error));
  });
};

export const getAdminSettingTitle = (setting) => {
  return setting in LIST_ADMIN_SETTINGS
    ? LIST_ADMIN_SETTINGS[setting]
    : setting
    ;
};
