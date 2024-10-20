import { Control, Controller } from 'react-hook-form';
import Select from 'react-select';
import { FieldValues, FieldErrors } from 'react-hook-form';
import { VaccineOption } from '../hooks/useVaccineOptions';


type VaccineSelectProps = {
  control: Control<FieldValues>;
  options: VaccineOption[];
  errors: FieldErrors<FieldValues>;
  label: string;
  required?: boolean;
}

export function VaccineSelect({ label, control, options, errors, required = false }: VaccineSelectProps) {
  return (
    <div>
      <label htmlFor="vaccine_id" className="block text-md font-medium text-gray-700">
        {label} {required && <span className="text-red-500">*</span>}
      </label>
      <Controller
        name="vaccine_id"
        control={control}
        render={({ field }) => (
          <Select
            {...field}
            options={options}
            onChange={(selectedOption) => field.onChange(selectedOption?.value)}
            value={options?.find(option => option.value === field.value)}
            isClearable
            placeholder="Selecione uma vacina"
          />
        )}
      />
      {errors.vaccine_id && <p className="text-red-500 text-xs mt-1">{errors.vaccine_id.message}</p>}
    </div>
  );
}