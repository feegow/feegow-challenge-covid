import { z } from 'zod';

import { formatDate, validateBrazilianDate } from '@/lib/dayjs';

const cpfSchema = z.string().regex(/^\d{3}\.\d{3}\.\d{3}-\d{2}$/, { message: 'CPF inválido' });

export const employeeFormSchema = z.object({
  full_name: z.string({ required_error: 'Nome completo é obrigatório' }).min(1, { message: 'Nome completo é obrigatório' }),
  birth_date: z
    .string({ required_error: 'Data de nascimento é obrigatória' })
    .min(1, { message: 'Data de nascimento é obrigatória' })
    .refine(validateBrazilianDate, { message: 'Data de nascimento inválida' })
    .transform((str) => formatDate(str, 'DD/MM/YYYY', 'YYYY-MM-DD')),
  first_dose_date: z
    .string()
    .refine((value) => !value || validateBrazilianDate(value), { message: 'Data da primeira dose inválida' })
    .optional()
    .transform((value) => (value ? formatDate(value, 'DD/MM/YYYY', 'YYYY-MM-DD') : undefined)),
  second_dose_date: z
    .string()
    .refine((value) => !value || validateBrazilianDate(value), { message: 'Data da segunda dose inválida' })
    .optional()
    .transform((value) => (value ? formatDate(value, 'DD/MM/YYYY', 'YYYY-MM-DD') : undefined)),
  third_dose_date: z
    .string()
    .refine((value) => !value || validateBrazilianDate(value), { message: 'Data da terceira dose inválida' })
    .optional()
    .transform((value) => (value ? formatDate(value, 'DD/MM/YYYY', 'YYYY-MM-DD') : undefined)),
  vaccine_id: z
    .union([z.number().int().positive({ message: 'Escolha uma vacina válida' }), z.null()])
    .optional(),
  has_comorbidity: z
    .union([z.enum(['true', 'false']), z.boolean()])
    .refine((value) => value !== undefined, { message: 'Campo obrigatório' })
    .transform((value) => {
      if (typeof value === 'boolean') return value;
      return value === 'true';
    }),
});

export const createEmployeeFormSchema = employeeFormSchema.extend({
  cpf: cpfSchema.min(1, { message: 'CPF é obrigatório' }),
});

export type EmployeeFormData = z.infer<typeof employeeFormSchema>;
export type CreateEmployeeFormData = z.infer<typeof createEmployeeFormSchema>;
