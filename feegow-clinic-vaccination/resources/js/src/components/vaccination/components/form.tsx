import { UseFormRegister, FieldValues, FieldErrors, Control } from 'react-hook-form';

import { FormDateField } from '../../common/form-date-field';
import { FormField } from '../../common/form-field';

type VaccineFormProps = {
  register: UseFormRegister<FieldValues>;
  errors: FieldErrors<FieldValues>;
  control: Control<FieldValues>;
};

// name: z.string().min(1, { message: 'Nome é obrigatório' }),
//   short_name: z.string().min(1, { message: 'Nome abreviado é obrigatório' }).optional(),
//     lot_number: z.string().min(1, { message: 'Número do lote é obrigatório' }),
//       expiration_date: z.string()
//         .refine(value => !value || validateBrazilianDate(value), { message: 'Data de validade inválida' })
//         .optional()
//         .transform(value => value ? convertFromBrazilianFormDate(value) : undefined),

export function VaccineForm({ register, errors, control }: VaccineFormProps) {
  return (
    <form className="space-y-4">
      <FormField
        label="Nome"
        name="name"
        register={register}
        errors={errors}
        type="text"
        placeholder="Digite o nome da vacina"
        required
      />
      <FormField
        label="Nome abreviado"
        name="short_name"
        register={register}
        errors={errors}
        type="text"
        placeholder="Digite o nome abreviado da vacina"
      />
      <FormField
        label="Número do lote"
        name="lot_number"
        register={register}
        errors={errors}
        type="text"
        placeholder="Digite o número do lote da vacina"
        required
      />
      <FormDateField label="Data de Validade" name="expiration_date" control={control} errors={errors} required />
    </form>
  );
}
