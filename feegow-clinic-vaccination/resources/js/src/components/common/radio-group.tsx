import { FieldErrors, FieldValues, Control, Controller } from 'react-hook-form';

interface RadioOption {
  value: string;
  label: string;
}

interface RadioGroupProps {
  label: string;
  name: string;
  control: Control<FieldValues>; // Changed from register to control
  options: RadioOption[];
  errors: FieldErrors<FieldValues>;
  required?: boolean;
}

export function RadioGroup({ label, name, control, options, errors, required = false }: RadioGroupProps) {
  return (
    <div>
      <label className="block text-md font-medium text-gray-700">
        {label} {required && <span className="text-red-500">*</span>}
      </label>
      <Controller
        name={name}
        control={control}
        render={({ field }) => (
          <div className="flex flex-col mt-2 gap-y-2">
            {options.map((option) => (
              <label key={option.value} className="flex items-center gap-x-2">
                <input
                  type="radio"
                  value={option.value}
                  checked={field.value === option.value}
                  onChange={() => field.onChange(option.value)}
                  id={`${name}-${option.value}`}
                />
                {option.label}
              </label>
            ))}
          </div>
        )}
      />
      {errors[name] && <p className="text-red-500 text-xs mt-1">{errors[name]?.message as string}</p>}
    </div>
  );
}