import { Button } from '@radix-ui/themes';
import { Trash2, X } from 'lucide-react';
import { memo, useCallback, useEffect, useMemo, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import { toast } from 'react-toastify';

import { Create } from '@/app/employee/create';
import { Edit } from '@/app/employee/edit';
import { AlertDialog } from '@/components/common/alert-dialog';
import { useVaccineOptions, VaccineOption } from '@/components/employee/hooks/useVaccineOptions';
import { MobileSearchButton } from '@/components/header/mobile-search-button';
import { SearchBar } from '@/components/header/search-bar';
import { List } from '@/components/list';
import { Pagination } from '@/components/list/pagination';
import { ListTable, TableBody, TableHeader } from '@/components/table';
import { usePagination } from '@/hooks/usePagination';
import dayjs from '@/lib/dayjs';
import { api } from '@/services/api';
import { Employee, PaginatedResponse } from '@/types';

type ActionsProps = {
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

const Actions = ({ refreshEmployees, vaccineOptions }: ActionsProps) => {
  return (
    <>
      <SearchBar />
      <MobileSearchButton />
      <Create refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />
    </>
  );
};

const columns = [
  { name: 'Nome', colspan: 2 },
  { name: 'CPF', colspan: 2 },
  { name: 'Data de Nascimento' },
  { name: '1ª Dose' },
  { name: '2ª Dose' },
  { name: '3ª Dose' },
  { name: 'Vacina' },
  { name: 'Comorbidade' },
  { name: 'Ações', colspan: 2 },
];

const formatDateOrShowNotVaccinated = (date: string | null) => {
  if (!date)
    return (
      <span title="Não vacinou">
        <X className="text-red-400 mx-auto" />
      </span>
    );
  return dayjs(date).format('DD/MM/YYYY');
};

type RowItemProps = {
  item: Employee;
  deleteEmployee: (id: number) => void;
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

const RowItem = memo(({ item, deleteEmployee, refreshEmployees, vaccineOptions }: RowItemProps) => {
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

const fetchEmployees = async (
  page: number,
  itemsPerPage: number,
  search: string | null,
): Promise<PaginatedResponse<Employee>> => {
  const response = await api.get<PaginatedResponse<Employee>>('/employees', {
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

export function EmployeeList() {
  const [employeesData, setEmployeesData] = useState<PaginatedResponse<Employee> | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const itemsPerPage = 15;
  const [searchParams] = useSearchParams();
  const search = searchParams.get('search');

  const { currentPage, setTotalPages, totalPages, goToPage } = usePagination({
    initialPage: 1,
    itemsPerPage,
  });

  const { vaccineOptions } = useVaccineOptions();

  const fetchEmployeesCallback = useCallback(
    async (page: number) => {
      setIsLoading(true);
      setError(null);
      try {
        const responseData = await fetchEmployees(page, itemsPerPage, search);
        setEmployeesData(responseData);
        setTotalPages(responseData.meta.last_page);
      } catch (err) {
        setError('Erro ao carregar colaboradores. Por favor, tente novamente.');
      } finally {
        setIsLoading(false);
      }
    },
    [itemsPerPage, search, setTotalPages],
  );

  useEffect(() => {
    fetchEmployeesCallback(currentPage);
  }, [currentPage, fetchEmployeesCallback]);

  const handlePageChange = useCallback(
    (page: number) => {
      goToPage(page);
    },
    [goToPage],
  );

  const refreshEmployees = useCallback(() => {
    fetchEmployeesCallback(currentPage);
  }, [fetchEmployeesCallback, currentPage]);

  const deleteEmployee = useCallback(
    async (id: number) => {
      try {
        await api.delete(`/employees/${id}`);
        refreshEmployees();
        toast.success('Colaborador excluído com sucesso.');
      } catch (error) {
        toast.error('Erro ao excluir colaborador.');
      }
    },
    [refreshEmployees],
  );

  const employeeRows = useMemo(() => {
    return employeesData?.data.map((item) => (
      <RowItem
        key={item.id}
        item={item}
        deleteEmployee={deleteEmployee}
        refreshEmployees={refreshEmployees}
        vaccineOptions={vaccineOptions}
      />
    ));
  }, [employeesData?.data, deleteEmployee, refreshEmployees, vaccineOptions]);

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
                  title="Colaboradores"
                  description="Lista de colaboradores."
                  actions={<Actions refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />}
                />
                <ListTable>
                  <TableHeader columns={columns} />
                  <TableBody>
                    {isLoading ? <LoadingRow /> : employeeRows}
                  </TableBody>
                </ListTable>
                <List.Footer>
                  <Pagination currentPage={currentPage} totalPages={totalPages} onPageChange={handlePageChange} />
                </List.Footer>
              </List>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
