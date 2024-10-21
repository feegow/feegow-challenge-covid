import { z } from 'zod';

import { formatDate, validateBrazilianDate } from '@/lib/dayjs';

export const vaccineFormSchema = z.object({
  name: z.string().min(1, { message: 'Nome é obrigatório' }),
  short_name: z.string().min(1, { message: 'Nome abreviado é obrigatório' }).optional(),
  lot_number: z.string().min(1, { message: 'Número do lote é obrigatório' }),
  expiration_date: z
    .string()
    .refine((value) => !value || validateBrazilianDate(value), { message: 'Data de validade inválida' })
    .optional()
    .transform((value) => (value ? formatDate(value, 'DD/MM/YYYY', 'YYYY-MM-DD') : undefined)),
});

export type VaccineFormData = z.infer<typeof vaccineFormSchema>;
