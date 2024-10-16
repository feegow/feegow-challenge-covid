import axios from 'axios';

declare global {
  interface Window {
    APP_URL: string;
    APP_LOCALE: string;
    APP_NAME: string;
    COMPANY_NAME: string;
  }
}

export const api = axios.create({
  baseURL: window.APP_URL + '/api',
});
