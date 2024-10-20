import { forwardRef } from 'react';
import { FieldErrors, FieldValues, Controller, Control } from 'react-hook-form';
import { PatternFormat, PatternFormatProps } from 'react-number-format';

type FormCpfFieldProps = {
  name: string;
  label: string;
  control: Control<FieldValues>; // Changed from register to control
  errors: FieldErrors<FieldValues>;
  required?: boolean;
};

const ForwardedPatternFormat = forwardRef<HTMLInputElement, PatternFormatProps>((props, ref) => (
  <PatternFormat {...props} getInputRef={ref} />
));

export function FormCpfField({ name, label, control, errors, required = false }: FormCpfFieldProps) {
  return (
    <div>
      <label htmlFor={name} className="block text-md font-medium text-gray-700">
        {label} {required && <span className="text-red-500">*</span>}
      </label>
      <Controller
        name={name}
        control={control}
        render={({ field }) => (
          <ForwardedPatternFormat
            {...field}
            format="###.###.###-##"
            mask="_"
            allowEmptyFormatting={false}
            placeholder="Digite o CPF"
            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          />
        )}
      />
      {errors[name] && <p className="text-red-500 text-xs mt-1">{errors[name]?.message as string}</p>}
    </div>
  );
}
