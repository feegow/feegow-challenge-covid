import { zodResolver } from '@hookform/resolvers/zod';
import { lazy, Suspense, useState } from 'react';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';

import { api } from '../../services/api';
import { AddButton } from '../common/add-btn';
import { ModalDialog } from '../common/modal-dialog';

import { createEmployeeFormSchema, CreateEmployeeFormData } from './employee-form-schema';
import { VaccineOption } from './hooks/useVaccineOptions';

const LazyEmployeeForm = lazy(() => import('./components/form').then((module) => ({ default: module.EmployeeForm })));

const Description = () => (
  <div className="flex flex-col mt-2 mb-5">
    <span className="text-gray-500">Insira os detalhes do novo colaborador.</span>
  </div>
);

type CreateProps = {
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

export function Create({ refreshEmployees, vaccineOptions }: CreateProps) {
  const [open, setOpen] = useState(false);

  const {
    register,
    handleSubmit,
    reset,
    formState: { errors, isSubmitting },
    control,
  } = useForm<CreateEmployeeFormData>({
    resolver: zodResolver(createEmployeeFormSchema),
    defaultValues: {
      has_comorbidity: false,
    },
  });

  const onSubmit = async (data: CreateEmployeeFormData): Promise<boolean> => {
    try {
      await api.post('/employees', data);
      toast.success('Colaborador cadastrado com sucesso!');
      refreshEmployees();
      reset();
      setOpen(false);
      return true;
    } catch (error) {
      console.error('Error saving employee:', error);
      toast.error('Erro ao cadastrar colaborador.');
      return false;
    }
  };

  return (
    <ModalDialog
      trigger={<AddButton isSubmitting={isSubmitting} />}
      title="Adicionar novo colaborador"
      description={<Description />}
      onSave={handleSubmit(onSubmit)}
      isLoading={isSubmitting}
      open={open}
      onOpenChange={setOpen}
    >
      <Suspense fallback={<div>Carregando formulário...</div>}>
        <LazyEmployeeForm register={register} errors={errors} control={control} vaccineOptions={vaccineOptions} />
      </Suspense>
    </ModalDialog>
  );
}
