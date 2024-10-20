import { Button } from '@radix-ui/themes';
import { Trash2, X } from 'lucide-react';
import { memo, useCallback, useEffect, useMemo, useState } from 'react';
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

const RowItem = memo(({ item, deleteVaccine, refreshVaccines }: RowItemProps) => {
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

const fetchVaccines = async (
  page: number,
  itemsPerPage: number,
  search: string | null,
): Promise<PaginatedResponse<Vaccine>> => {
  const response = await api.get<PaginatedResponse<Vaccine>>('/vaccines', {
    params: {
      page: page,
      per_page: itemsPerPage,
      search,
    },
  });
  return response.data;
};

const LoadingRow = () => {
  const columnsLength = useMemo(() => columns.reduce((total, column) => total + (column.colspan || 1), 0), []);
  return (
    <tr>
      <td colSpan={columnsLength} className="text-center py-4">
        <div
          className="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
          role="status"
        >
          <span className="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">
            Carregando...
          </span>
        </div>
      </td>
    </tr>
  );
};

export function VaccineList() {
  const [vaccinesData, setVaccinesData] = useState<PaginatedResponse<Vaccine> | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const itemsPerPage = 15;
  const [searchParams] = useSearchParams();
  const search = searchParams.get('search');

  const { currentPage, setTotalPages, totalPages, goToPage } = usePagination({
    initialPage: 1,
    itemsPerPage,
  });

  const fetchVaccinesCallback = useCallback(
    async (page: number) => {
      setIsLoading(true);
      setError(null);
      try {
        const responseData = await fetchVaccines(page, itemsPerPage, search);
        setVaccinesData(responseData);
        setTotalPages(responseData.meta.last_page);
      } catch (err) {
        setError('Error loading vaccines. Please try again.');
      } finally {
        setIsLoading(false);
      }
    },
    [itemsPerPage, search, setTotalPages],
  );

  useEffect(() => {
    fetchVaccinesCallback(currentPage);
  }, [currentPage, fetchVaccinesCallback]);

  const handlePageChange = useCallback(
    (page: number) => {
      goToPage(page);
    },
    [goToPage],
  );

  const refreshVaccines = useCallback(() => {
    fetchVaccinesCallback(currentPage);
  }, [fetchVaccinesCallback, currentPage]);

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

  const vaccineRows = useMemo(() => {
    return vaccinesData?.data.map((item) => (
      <RowItem
        key={item.id}
        item={item}
        deleteVaccine={deleteVaccine}
        refreshVaccines={refreshVaccines}
      />
    ));
  }, [vaccinesData?.data, deleteVaccine, refreshVaccines]);

  if (error) {
    return <div className="text-center py-4 text-red-500">{error}</div>;
  }

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
                    {isLoading ? <LoadingRow /> : vaccineRows}
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