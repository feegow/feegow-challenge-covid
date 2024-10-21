import { zodResolver } from '@hookform/resolvers/zod';
import { lazy, Suspense, useState } from 'react';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';

import { EditButton } from '@/components/common/edit-btn';
import { ModalDialog } from '@/components/common/modal-dialog';
import { employeeFormSchema, EmployeeFormData } from '@/components/employee/employee-form-schema';
import { VaccineOption } from '@/components/employee/hooks/useVaccineOptions';
import { formatDate } from '@/lib/dayjs';
import { api } from '@/services/api';
import { Employee } from '@/types';

const LazyEmployeeForm = lazy(() => import('@/components/employee/form').then((module) => ({ default: module.EmployeeForm })));

const Description = () => (
  <div className="flex flex-col mt-2 mb-5">
    <span className="text-gray-500">Edite os detalhes do colaborador.</span>
  </div>
);

type EditProps = {
  employee: Employee;
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

export function Edit({ employee, refreshEmployees, vaccineOptions }: EditProps) {
  const [open, setOpen] = useState(false);

  const defaultValues: EmployeeFormData = {
    ...employee,
    birth_date: employee.birth_date ? formatDate(String(employee.birth_date)) : '',
    first_dose_date: employee.first_dose_date ? formatDate(String(employee.first_dose_date)) : '',
    second_dose_date: employee.second_dose_date ? formatDate(String(employee.second_dose_date)) : '',
    third_dose_date: employee.third_dose_date ? formatDate(String(employee.third_dose_date)) : '',
    has_comorbidity: employee.has_comorbidity === true ? 'true' : 'false',
  };

  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
    control,
  } = useForm<EmployeeFormData>({
    resolver: zodResolver(employeeFormSchema),
    defaultValues,
  });

  const onSubmit = async (data: EmployeeFormData): Promise<boolean> => {
    try {
      // Remove CPF from the data before sending to the API
      const { cpf, ...dataWithoutCPF } = data;

      await api.put(`/employees/${employee.id}`, dataWithoutCPF);
      toast.success('Colaborador atualizado com sucesso!');
      refreshEmployees();
      setOpen(false);
      return true;
    } catch (error) {
      console.error('Error updating employee:', error);
      toast.error('Erro ao atualizar colaborador.');
      return false;
    }
  };

  return (
    <ModalDialog
      trigger={<EditButton isSubmitting={isSubmitting} />}
      title="Editar colaborador"
      description={<Description />}
      onSave={handleSubmit(onSubmit)}
      isLoading={isSubmitting}
      open={open}
      onOpenChange={setOpen}
    >
      <Suspense fallback={<div>Carregando formulário...</div>}>
        <LazyEmployeeForm
          register={register}
          errors={errors}
          control={control}
          vaccineOptions={vaccineOptions}
          protectCPF
        />
      </Suspense>
    </ModalDialog>
  );
}
