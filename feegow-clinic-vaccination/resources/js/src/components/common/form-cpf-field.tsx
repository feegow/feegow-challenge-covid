import { forwardRef, useMemo, memo } from 'react';
import { FieldErrors, FieldValues, Controller, Control } from 'react-hook-form';
import { PatternFormat, PatternFormatProps } from 'react-number-format';

type FormCpfFieldProps = {
  name: string;
  label: string;
  control: Control<FieldValues>;
  errors: FieldErrors<FieldValues>;
  required?: boolean;
  inputProps?: PatternFormatProps;
};

const ForwardedPatternFormat = memo(forwardRef<HTMLInputElement, PatternFormatProps>((props, ref) => (
  <PatternFormat {...props} getInputRef={ref} />
)));

ForwardedPatternFormat.displayName = 'ForwardedPatternFormat';

export const FormCpfField = memo((props: FormCpfFieldProps) => {
  const { name, label, control, errors, required = false, inputProps } = props;
  const renderInput = useMemo(() => {
    return ({ field }: { field: FieldValues }) => (
      <ForwardedPatternFormat
        value={field.value}
        onChange={field.onChange}
        onBlur={field.onBlur}
        name={field.name}
        format="###.###.###-##"
        placeholder="Digite o CPF"
        allowEmptyFormatting={false}
        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        {...inputProps}
      />
    );
  }, []);

  return (
    <div>
      <label htmlFor={name} className="block text-md font-medium text-gray-700">
        {label} {required && <span className="text-red-500">*</span>}
      </label>
      <Controller
        name={name}
        control={control}
        render={renderInput}
      />
      {errors[name] && <p className="text-red-500 text-xs mt-1">{errors[name]?.message as string}</p>}
    </div>
  );
});

FormCpfField.displayName = 'FormCpfField';