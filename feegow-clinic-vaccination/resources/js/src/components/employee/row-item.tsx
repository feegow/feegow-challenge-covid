import { Button } from '@radix-ui/themes';
import { X, Trash2 } from 'lucide-react';
import { memo } from 'react';

import { VaccineOption } from './hooks/useVaccineOptions';

import { Edit } from '@/app/employee/edit';
import { AlertDialog } from '@/components/common/alert-dialog';
import { formatDate } from '@/lib/dayjs';
import { Employee } from '@/types';

const formatDateOrShowNotVaccinated = (date: string | null) => {
  if (!date)
    return (
      <span title="Não vacinou">
        <X className="text-red-400 mx-auto" />
      </span>
    );
  return formatDate(date);
};

type RowItemProps = {
  item: Employee;
  deleteEmployee: (id: number) => void;
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

export const RowItem = memo(({ item, deleteEmployee, refreshEmployees, vaccineOptions }: RowItemProps) => {
  return (
    <tr className="hover:bg-gray-100">
      <td className="py-3 px-4" colSpan={2}>
        {item.full_name}
      </td>
      <td className="py-3 px-4" colSpan={2}>
        {item.cpf}
      </td>
      <td className="py-3 px-4">{formatDateOrShowNotVaccinated(item.birth_date)}</td>
      <td className="py-3 px-4">{formatDateOrShowNotVaccinated(item.first_dose_date)}</td>
      <td className="py-3 px-4">{formatDateOrShowNotVaccinated(item.second_dose_date)}</td>
      <td className="py-3 px-4">{formatDateOrShowNotVaccinated(item.third_dose_date)}</td>
      <td className="py-3 px-4">{item.vaccine_short_name || 'Não vacinou'}</td>
      <td className="py-3 px-4">{item.has_comorbidity ? 'Sim' : 'Não'}</td>
      <td className="py-3 px-4" colSpan={2}>
        <div className="flex items-center justify-center h-full w-full gap-x-4">
          <Edit employee={item} key={item.id} refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />
          <AlertDialog
            trigger={
              <Button className="cursor-pointer w-6 h-6" title="Excluir" variant="soft">
                <Trash2 />
              </Button>
            }
            title="Tem certeza?"
            description="Esta ação não pode ser desfeita."
            confirmText="Sim, excluir colaborador"
            onConfirm={() => deleteEmployee(item.id)}
          />
        </div>
      </td>
    </tr>
  );
});