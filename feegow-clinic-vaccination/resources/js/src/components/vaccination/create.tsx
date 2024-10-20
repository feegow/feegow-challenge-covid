import { zodResolver } from '@hookform/resolvers/zod';
import { lazy, Suspense, useState } from 'react';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';

import { api } from '../../services/api';
import { ModalDialog } from '../common/modal-dialog';

import { AddButton } from './components/add-btn';
import { vaccineFormSchema, VaccineFormData } from './vaccine-form-schema';

const LazyVaccineForm = lazy(() => import('./components/form').then((module) => ({ default: module.VaccineForm })));

const Description = () => (
  <div className="flex flex-col mt-2 mb-5">
    <span className="text-gray-500">Insira os detalhes da nova vacina.</span>
  </div>
);

type CreateProps = {
  refreshVaccines: () => void;
};

export function Create({ refreshVaccines }: CreateProps) {
  const [open, setOpen] = useState(false);

  const {
    register,
    handleSubmit,
    reset,
    formState: { errors, isSubmitting },
    control,
  } = useForm<VaccineFormData>({
    resolver: zodResolver(vaccineFormSchema),
    defaultValues: {
      has_comorbidity: false,
    },
  });

  const onSubmit = async (data: VaccineFormData): Promise<boolean> => {
    try {
      await api.post('/vaccines', data);
      toast.success('Vacina cadastrada com sucesso!');
      refreshVaccines();
      reset();
      setOpen(false);
      return true;
    } catch (error) {
      console.error('Error saving vaccine:', error);
      toast.error('Erro ao cadastrar vacina.');
      return false;
    }
  };

  return (
    <ModalDialog
      trigger={<AddButton isSubmitting={isSubmitting} />}
      title="Adicionar nova vacina"
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