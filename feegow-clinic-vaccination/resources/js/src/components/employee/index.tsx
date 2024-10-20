import { useCallback, useEffect, useState } from 'react';
import { List } from '../list';
import { ListTable, TableBody, TableHeader } from '../table';
import { api } from '@/services/api';
import { usePagination } from '@/hooks/usePagination';
import { Pagination } from '../list/pagination';
import { Employee, PaginatedResponse } from '@/types';
import dayjs from '@/lib/dayjs';
import { MobileSearchButton } from '../header/mobile-search-button';
import { SearchBar } from '../header/search-bar';
import { Button } from '@radix-ui/themes';
import { Trash2, X } from 'lucide-react';
import { useSearchParams } from 'react-router-dom';
import { Create } from './create';
import { AlertDialog } from '../common/alert-dialog';
import { toast } from 'react-toastify';
import { Edit } from './edit';
import { useVaccineOptions, VaccineOption } from './hooks/useVaccineOptions';

type ActionsProps = {
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
}

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

const formatDate = (date: string) => {
  if (!date) return <span title='Não vacinou'><X className='text-red-400 mx-auto' /></span>;
  return dayjs(date).format('DD/MM/YYYY');
};

type RowItemProps = {
  item: Employee;
  deleteEmployee: (id: number) => void;
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
}

const RowItem = ({ item, deleteEmployee, refreshEmployees, vaccineOptions }: RowItemProps) => {
  return (
    <tr className='hover:bg-gray-100'>
      <td className='py-3 px-4' colSpan={2}>{item.full_name}</td>
      <td className='py-3 px-4' colSpan={2}>{item.cpf}</td>
      <td className='py-3 px-4'>{formatDate(item.birth_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.first_dose_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.second_dose_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.third_dose_date)}</td>
      <td className='py-3 px-4'>{item.vaccine_short_name}</td>
      <td className='py-3 px-4'>{item.has_comorbidity ? 'Sim' : 'Não'}</td>
      <td className='py-3 px-4' colSpan={2}>
        <div className='flex items-center justify-center h-full w-full gap-x-4'>
          <Edit employee={item} key={item.id} refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />
          <AlertDialog
            trigger={<Button className='cursor-pointer w-6 h-6' title='Excluir' variant="soft"><Trash2 /></Button>}
            title="Tem certeza?"
            description="Esta ação não pode ser desfeita."
            confirmText="Sim, excluir colaborador"
            onConfirm={() => deleteEmployee(item.id)}
          />
        </div>
      </td>
    </tr>
  );
};


export function EmployeeList() {
  const [employees, setEmployees] = useState<Employee[]>([]);
  const itemsPerPage = 15;
  const [searchParams] = useSearchParams();
  const search = searchParams.get('search');

  const { currentPage, setTotalPages, totalPages, goToPage } = usePagination({
    initialPage: 1,
    itemsPerPage,
  });

  const { vaccineOptions } = useVaccineOptions();

  const fetchEmployees = useCallback(async (page: number) => {
    const response = await api.get<PaginatedResponse<Employee>>('/employees', {
      params: {
        page: page,
        per_page: itemsPerPage,
        search,
      },
    });
    const responseData = response.data;
    setEmployees(responseData.data);
    setTotalPages(responseData.meta.last_page);
  }, [setTotalPages, search]);

  const refreshEmployees = useCallback(() => {
    fetchEmployees(currentPage);
  }, [fetchEmployees, currentPage]);

  useEffect(() => {
    fetchEmployees(currentPage);
  }, [currentPage, fetchEmployees, search]);

  const handlePageChange = (page: number) => {
    goToPage(page);
  };

  const deleteEmployee = useCallback(async (id: number) => {
    try {
      await api.delete(`/employees/${id}`);
      refreshEmployees();
      toast.success('Colaborador excluído com sucesso.');
    } catch (error) {
      toast.error('Erro ao excluir colaborador.');
    }
  }, [refreshEmployees]);

  return (
    <>
      <div className="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div className="flex flex-col">
          <div className="-m-1.5 overflow-x-auto">
            <div className="p-1.5 min-w-full inline-block align-middle">
              <List>
                <List.Header title="Colaboradores" description="Lista de colaboradores." actions={<Actions refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />} />
                <ListTable>
                  <TableHeader columns={columns} />
                  <TableBody
                    data={employees}
                    renderRow={(item) => (
                      <RowItem item={item} key={item.cpf} deleteEmployee={deleteEmployee} refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />
                    )}
                  />
                </ListTable>
                <List.Footer>
                  <Pagination
                    currentPage={currentPage}
                    totalItems={employees.length}
                    itemsPerPage={itemsPerPage}
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