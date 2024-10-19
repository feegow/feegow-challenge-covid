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

const Actions = () => {
  return (
    <>
      <SearchBar />
      <MobileSearchButton />
      <a
        className="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
        href="#"
      >
        Ver todos
      </a>
      <a
        className="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        href="#"
      >
        <svg
          className="shrink-0 size-4"
          xmlns="http://www.w3.org/2000/svg"
          width={24}
          height={24}
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth={2}
          strokeLinecap="round"
          strokeLinejoin="round"
        >
          <path d="M5 12h14" />
          <path d="M12 5v14" />
        </svg>
        Adicionar
      </a>
    </>
  );
};

const columns = [
  'Nome',
  'CPF',
  'Data de Nascimento',
  '1ª Dose',
  '2ª Dose',
  '3ª Dose',
  'Vacina',
  'Comorbidade',
  'Ações',
];

const formatDate = (date: string) => {
  return dayjs(date).format('DD/MM/YYYY');
};


const RowItem = ({ item }: { item: Employee }) => {
  return (
    <tr className='hover:bg-gray-100'>
      <td className='py-3 px-4'>{item.full_name}</td>
      <td className='py-3 px-4'>{item.cpf}</td>
      <td className='py-3 px-4'>{formatDate(item.birth_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.first_dose_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.second_dose_date)}</td>
      <td className='py-3 px-4'>{formatDate(item.third_dose_date)}</td>
      <td className='py-3 px-4'>{item.vaccine_short_name}</td>
      <td className='py-3 px-4'>{item.has_comorbidity ? 'Sim' : 'Não'}</td>
      <td className='py-3 px-4'>
        <button>Editar</button>
        <button>Excluir</button>
      </td>
    </tr>
  );
};


export function EmployeeList() {
  const [employees, setEmployees] = useState<Employee[]>([]);
  const itemsPerPage = 15;
  const { currentPage, setTotalPages, totalPages, goToPage } = usePagination({
    initialPage: 1,
    itemsPerPage,
  });

  const fetchEmployees = useCallback(async (page: number) => {
    const response = await api.get<PaginatedResponse<Employee>>('/employees', {
      params: {
        page: page,
        per_page: itemsPerPage,
      },
    });
    const responseData = response.data;
    setEmployees(responseData.data);
    setTotalPages(responseData.meta.last_page);
  }, [setTotalPages]);

  useEffect(() => {
    fetchEmployees(currentPage);
  }, [currentPage, fetchEmployees]);

  const handlePageChange = (page: number) => {
    goToPage(page);
  };

  return (
    <>
      <div className="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div className="flex flex-col">
          <div className="-m-1.5 overflow-x-auto">
            <div className="p-1.5 min-w-full inline-block align-middle">
              <List>
                <List.Header title="Colaboradores" description="Lista de colaboradores." actions={<Actions />} />
                <ListTable>
                  <TableHeader columns={columns} />
                  <TableBody
                    data={employees}
                    renderRow={(item) => (
                      <RowItem item={item} key={item.cpf} />
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