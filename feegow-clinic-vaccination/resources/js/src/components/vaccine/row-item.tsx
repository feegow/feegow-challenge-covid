import { Button } from '@radix-ui/themes';
import { Trash2 } from 'lucide-react';
import { memo } from 'react';

import { Edit } from '@/app/vaccine/edit';
import { AlertDialog } from '@/components/common/alert-dialog';
import { formatDate } from '@/lib/dayjs';
import { Vaccine } from '@/types';

type RowItemProps = {
  item: Vaccine;
  deleteVaccine: (id: number) => void;
  refreshVaccines: () => void;
};

export const RowItem = memo(({ item, deleteVaccine, refreshVaccines }: RowItemProps) => {
  return (
    <tr className="hover:bg-gray-100">
      <td className="py-3 px-4" colSpan={2}>
        {item.name}
      </td>
      <td className="py-3 px-4" colSpan={2}>
        {item.short_name}
      </td>
      <td className="py-3 px-4">{item.lot_number}</td>
      <td className="py-3 px-4">{formatDate(item.expiration_date)}</td>
      <td className="py-3 px-4" colSpan={2}>
        <div className="flex items-center justify-center h-full w-full gap-x-4">
          <Edit vaccine={item} key={item.id} refreshVaccines={refreshVaccines} />
          <AlertDialog
            trigger={
              <Button className="cursor-pointer w-6 h-6" title="Excluir" variant="soft">
                <Trash2 />
              </Button>
            }
            title="Tem certeza?"
            description="Esta ação não pode ser desfeita."
            confirmText="Sim, excluir vacina"
            onConfirm={() => deleteVaccine(item.id)}
          />
        </div>
      </td>
    </tr>
  );
});