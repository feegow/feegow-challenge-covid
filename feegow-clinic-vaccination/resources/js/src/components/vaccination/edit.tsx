import { zodResolver } from '@hookform/resolvers/zod';
import { lazy, Suspense, useState } from 'react';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';

import { formatToBrazilianDate } from '../../lib/dayjs';
import { api } from '../../services/api';
import { Employee } from '../../types';
import { EditButton } from '../common/edit-btn';
import { ModalDialog } from '../common/modal-dialog';

import { vaccineFormSchema, VaccineFormData } from './vaccine-form-schema';

const LazyVaccineForm = lazy(() => import('./components/form').then((module) => ({ default: module.VaccineForm })));

const Description = () => (
  <div className="flex flex-col mt-2 mb-5">
    <span className="text-gray-500">Edite os detalhes da vacina.</span>
  </div>
);

type EditProps = {
  employee: Employee;
  refreshEmployees: () => void;
};

export function Edit({ vaccine, refreshVaccines }: EditProps) {
  const [open, setOpen] = useState(false);

  const defaultValues: VaccineFormData = {
    ...vaccine,
    expiration_date: vaccine.expiration_date ? formatToBrazilianDate(String(vaccine.expiration_date)) : '',
  };

  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
    control,
  } = useForm<VaccineFormData>({
    resolver: zodResolver(vaccineFormSchema),
    defaultValues,
  });

  const onSubmit = async (data: VaccineFormData): Promise<boolean> => {
    try {
      await api.put(`/vaccines/${vaccine.id}`, data);
      toast.success('Vacina atualizada com sucesso!');
      refreshVaccines();
      setOpen(false);
      return true;
    } catch (error) {
      console.error('Error updating vaccine:', error);
      toast.error('Erro ao atualizar vacina.');
      return false;
    }
  };

  return (
    <ModalDialog
      trigger={<EditButton isSubmitting={isSubmitting} />}
      title="Editar vacina"
      description={<Description />}
      onSave={handleSubmit(onSubmit)}
      isLoading={isSubmitting}
      open={open}
      onOpenChange={setOpen}
    >
      <Suspense fallback={<div>Carregando formulário...</div>}>
        <LazyVaccineForm register={register} errors={errors} control={control} />
      </Suspense>
    </ModalDialog>
  );
}
