
import { useCallback, useEffect, useMemo, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import { toast } from 'react-toastify';

import { LoadingRow } from '@/components/common/loading-row';
import { List } from '@/components/list';
import { Pagination } from '@/components/list/pagination';
import { ListTable, TableBody, TableHeader } from '@/components/table';
import { Actions } from '@/components/vaccine/actions';
import { RowItem } from '@/components/vaccine/row-item';
import { usePagination } from '@/hooks/usePagination';
import { api } from '@/services/api';
import { Vaccine, PaginatedResponse } from '@/types';

const columns = [
  { name: 'Nome', colspan: 2 },
  { name: 'Apelido', colspan: 2 },
  { name: 'Número do lote' },
  { name: 'Data de validade' },
  { name: 'Ações', colspan: 2 },
];

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
        setError('Erro ao carregar vacinas. Por favor, tente novamente.');
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
                    {isLoading ? <LoadingRow columns={columns} /> : vaccineRows}
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