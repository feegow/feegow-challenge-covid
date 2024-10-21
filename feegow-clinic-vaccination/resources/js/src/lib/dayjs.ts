import dayjs from 'dayjs';
import 'dayjs/locale/pt-br';
import customParseFormat from 'dayjs/plugin/customParseFormat';

dayjs.locale('pt-br');
dayjs.extend(customParseFormat);

export const validateBrazilianDate = (value: string) => {
  return dayjs(value, 'DD/MM/YYYY', true).isValid();
};

export const formatDate = (value: string, originalFormat: string = 'YYYY-MM-DD', outputFormat: string = 'DD/MM/YYYY') => {
  if (!value) return '';
  return dayjs(value, originalFormat, true).format(outputFormat);
};

export default dayjs;
