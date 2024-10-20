import dayjs from 'dayjs';
import 'dayjs/locale/pt-br';
import customParseFormat from 'dayjs/plugin/customParseFormat';


dayjs.locale('pt-br');
dayjs.extend(customParseFormat);



export const validateBrazilianDate = (value: string) => {
  return dayjs(value, 'DD/MM/YYYY', true).isValid();
};

export const formatToBrazilianDate = (value: string) => {
  if (!value) return '';
  return dayjs(value, 'YYYY-MM-DD', true).format('DD/MM/YYYY');
};

export const convertFromBrazilianFormDate = (value: string) => {
  if (!value) return '';
  return dayjs(value, 'DD/MM/YYYY', true).format('YYYY-MM-DD');
};

export default dayjs;
