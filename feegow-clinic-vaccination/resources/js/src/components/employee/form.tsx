import { UseFormRegister, FieldErrors, Control } from 'react-hook-form';


import { FormCpfField } from '@/components/common/form-cpf-field';
import { FormDateField } from '@/components/common/form-date-field';
import { FormField } from '@/components/common/form-field';
import { RadioGroup } from '@/components/common/radio-group';
import { CreateEmployeeFormData } from '@/components/employee/employee-form-schema';
import { VaccineOption } from '@/components/employee/hooks/useVaccineOptions';
import { VaccineSelect } from '@/components/employee/vaccine-select';

type EmployeeFormProps = {
  register: UseFormRegister<CreateEmployeeFormData>;
  errors: FieldErrors<CreateEmployeeFormData>;
  control: Control<CreateEmployeeFormData>;
  vaccineOptions: VaccineOption[];
  protectCPF: boolean;
};

export function EmployeeForm({ protectCPF = false, register, errors, control, vaccineOptions }: EmployeeFormProps) {
  return (
    <form className="space-y-4">
      <FormField
        label="Nome Completo"
        name="full_name"
        register={register}
        errors={errors}
        type="text"
        placeholder="Digite o nome completo"
        required
      />
      {protectCPF ? (
        <p className="block cursor-default text-md font-medium text-gray-700 my-2">CPF não pode ser alterado</p>
      ) : (
        <FormCpfField label="CPF" name="cpf" control={control} errors={errors} required />
      )}
      <FormDateField label="Data de Nascimento" name="birth_date" control={control} errors={errors} required />
      <FormDateField label="Data da Primeira Dose" name="first_dose_date" control={control} errors={errors} />
      <FormDateField label="Data da Segunda Dose" name="second_dose_date" control={control} errors={errors} />
      <FormDateField label="Data da Terceira Dose" name="third_dose_date" control={control} errors={errors} />
      <VaccineSelect label="Vacina" control={control} options={vaccineOptions} errors={errors} />
      <RadioGroup
        label="Possui Comorbidade"
        name="has_comorbidity"
        control={control}
        errors={errors}
        required
        options={[
          { value: 'true', label: 'Sim' },
          { value: 'false', label: 'Não' },
        ]}
      />
    </form>
  );
}
