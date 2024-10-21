import { UseFormRegister, FieldErrors, Control } from 'react-hook-form';

import { FormDateField } from '@/components/common/form-date-field';
import { FormField } from '@/components/common/form-field';
import { VaccineFormData } from '@/components/vaccine/vaccine-form-schema';

type VaccineFormProps = {
  register: UseFormRegister<VaccineFormData>;
  errors: FieldErrors<VaccineFormData>;
  control: Control<VaccineFormData>;
};

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
      <FormDateField label="Data de Validade" name="expiration_date" control={control} errors={errors} required autoComplete="off" />
    </form>
  );
}
