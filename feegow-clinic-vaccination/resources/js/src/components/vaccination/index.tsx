import { Button } from '@radix-ui/themes';
import { Trash2, X } from 'lucide-react';
import { useCallback, useEffect, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import { toast } from 'react-toastify';

import { AlertDialog } from '../common/alert-dialog';
import { MobileSearchButton } from '../header/mobile-search-button';
import { SearchBar } from '../header/search-bar';
import { List } from '../list';
import { Pagination } from '../list/pagination';
import { ListTable, TableBody, TableHeader } from '../table';

import { Create } from './create';
import { Edit } from './edit';

import { usePagination } from '@/hooks/usePagination';
import dayjs from '@/lib/dayjs';
import { api } from '@/services/api';
import { Vaccine, PaginatedResponse } from '@/types';


type ActionsProps = {
  refreshVaccines: () => void;
};

const Actions = ({ refreshVaccines }: ActionsProps) => {
  return (
    <>
      <SearchBar />
      <MobileSearchButton />
      <Create refreshVaccines={refreshVaccines} />
    </>
  );
};

const columns = [
  { name: 'Nome', colspan: 2 },
  { name: 'Apelido', colspan: 2 },
  { name: 'Número do lote' },
  { name: 'Data de validade' },
  { name: 'Ações', colspan: 2 },
];

const formatDate = (date: string) => {
  if (!date)
    return (
      <span title="Não vacinou">
        <X className="text-red-400 mx-auto" />
      </span>
    );
  return dayjs(date).format('DD/MM/YYYY');
};

type RowItemProps = {
  item: Vaccine;
  deleteVaccine: (id: number) => void;
  refreshVaccines: () => void;
};

const RowItem = ({ item, deleteVaccine, refreshVaccines }: RowItemProps) => {
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
};

export function VaccineList() {
  const [vaccines, setVaccines] = useState<Vaccine[]>([]);
  const itemsPerPage = 15;
  const [searchParams] = useSearchParams();
  const search = searchParams.get('search');

  const { currentPage, setTotalPages, totalPages, goToPage } = usePagination({
    initialPage: 1,
    itemsPerPage,
  });

  const fetchVaccines = useCallback(
    async (page: number) => {
      const response = await api.get<PaginatedResponse<Vaccine>>('/vaccines', {
        params: {
          page: page,
          per_page: itemsPerPage,
          search,
        },
      });
      const responseData = response.data;
      setVaccines(responseData.data);
      setTotalPages(responseData.meta.last_page);
    },
    [setTotalPages, search],
  );

  const refreshVaccines = useCallback(() => {
    fetchVaccines(currentPage);
  }, [fetchVaccines, currentPage]);

  useEffect(() => {
    fetchVaccines(currentPage);
  }, [currentPage, fetchVaccines, search]);

  const handlePageChange = (page: number) => {
    goToPage(page);
  };

  const deleteVaccine = useCallback(
    async (id: number) => {
      try {
        await api.delete(`/vaccines/${id}`);
        refreshVaccines();
        toast.success('Vacina excluída com sucesso.');
      } catch (error) {
        toast.error('Erro ao excluir vacina.');
      }
    },
    [refreshVaccines],
  );

  return (
    <>
      <div className="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div className="flex flex-col">
          <div className="-m-1.5 overflow-x-auto">
            <div className="p-1.5 min-w-full inline-block align-middle">
              <List>
                <List.Header
                  title="Vacinas"
                  description="Lista de vacinas."
                  actions={<Actions refreshVaccines={refreshVaccines} />}
                />
                <ListTable>
                  <TableHeader columns={columns} />
                  <TableBody>
                    {vaccines.map((item) => (
                      <RowItem
                        item={item}
                        key={item.id}
                        deleteVaccine={deleteVaccine}
                        refreshVaccines={refreshVaccines}
                      />
                    ))}
                  </TableBody>
                </ListTable>
                <List.Footer>
                  <Pagination
                    currentPage={currentPage}
                    totalPages={totalPages}
                    onPageChange={handlePageChange}
                  />
                </List.Footer>
              </List>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
