import { FormField } from '../../common/form-field';
import { VaccineSelect } from './vaccine-select';
import { UseFormRegister, FieldValues, FieldErrors, Control } from 'react-hook-form';
import { FormDateField } from '../../common/form-date-field';
import { FormCpfField } from '../../common/form-cpf-field';
import { RadioGroup } from '../../common/radio-group';
import { VaccineOption } from '../hooks/useVaccineOptions';

type EmployeeFormProps = {
  register: UseFormRegister<FieldValues>;
  errors: FieldErrors<FieldValues>;
  control: Control<FieldValues>;
  vaccineOptions: VaccineOption[];
  protectCPF: boolean;
}

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
      {protectCPF ? <p className="block cursor-default text-md font-medium text-gray-700 my-2">CPF não pode ser alterado</p> : <FormCpfField
        label="CPF"
        name="cpf"
        control={control}
        errors={errors}
        required
      />}
      <FormDateField
        label="Data de Nascimento"
        name="birth_date"
        control={control}
        errors={errors}
        required
      />
      <FormDateField
        label="Data da Primeira Dose"
        name="first_dose_date"
        control={control}
        errors={errors}
      />
      <FormDateField
        label="Data da Segunda Dose"
        name="second_dose_date"
        control={control}
        errors={errors}
      />
      <FormDateField
        label="Data da Terceira Dose"
        name="third_dose_date"
        control={control}
        errors={errors}
      />
      <VaccineSelect
        label="Vacina"
        control={control}
        options={vaccineOptions}
        errors={errors}
        required
      />
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