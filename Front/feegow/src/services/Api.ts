import axios from 'axios';

const configValue: string = (process.env.REACT_APP_API_URL as string);
const apiService = axios.create({
    baseURL: configValue,
});
console.log(configValue);
apiService.interceptors.request.use(async config => {
    config.headers = {
        Accept: 'application/json',
        ContentType: 'application/json',
    };
    return config;
});

export default apiService;