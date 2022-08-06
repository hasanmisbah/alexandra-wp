import { collection, LIST_ADMIN_SETTINGS } from '@/util/constants';

const jQuery = window.jQuery;
export const getAjaxUrl = collection?.ajax_url;

export const getApiResponse = ({ type = 'POST', data = {}, url = getAjaxUrl }) => {

  const requestTypes = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

  if (!requestTypes.includes(type?.toUpperCase())) {
    throw new Error(`Invalid request type: ${ type }`);
  }

  return new Promise((resolve, reject) => {

    jQuery.ajax({
        url: url,
        data: data,
        type: type,
      })
      .success((response) => {

        return resolve(response);

      })
      .fail((error) => {

        return  reject(error);

      });
  });
};

export const getAdminSettingTitle = (setting) => {
  return setting in LIST_ADMIN_SETTINGS
    ? LIST_ADMIN_SETTINGS[setting]
    : setting
    ;
};
