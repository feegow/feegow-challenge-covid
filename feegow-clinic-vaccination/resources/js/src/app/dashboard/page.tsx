import { useCallback, useEffect, useState } from 'react';

import VaccineChart from '@/components/dashboard/vaccine-chart';
import { api } from '@/services/api';

type Stats = {
  employees: number;
  vaccines: number;
  reports: number;
}

type VaccinationReport = {
  vaccine: string;
  total: number;
  vaccinated_count: number;
};

export default function Dashboard() {
  const [stats, setStats] = useState<Stats>({
    employees: 0,
    vaccines: 0,
    reports: 0,
  });
  const [data, setData] = useState<VaccinationReport[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const fetchStats = useCallback(async () => {
    try {
      const response = await api.get<Stats>('/stats');
      setStats(response.data);
    } catch (error) {
      console.error(error);
    }
  }, []);

  const fetchVaccinationData = useCallback(async () => {
    try {
      const response = await api.get<VaccinationReport[]>('/stats/vaccination-report'); // Adjust the API endpoint as necessary
      setData(response.data);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  }, []);


  useEffect(() => {
    fetchStats();
    fetchVaccinationData();
  }, []);

  if (loading) {
    return <div>Carregando...</div>;
  }

  if (error) {
    return <div>Erro: {error}</div>;
  }

  return (
    <div className="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div className="grid sm:grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <div className="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div className="p-4 md:p-5">
            <div className="flex items-center gap-x-2">
              <p className="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Colaboradores
              </p>
              <div className="hs-tooltip">
                <div className="hs-tooltip-toggle">
                  <svg
                    className="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  >
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                  </svg>
                  <span className="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700">
                    The number of daily users
                  </span>
                </div>
              </div>
            </div>
            <div className="mt-1 flex items-center gap-x-2">
              <h3 className="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {stats.employees}
              </h3>
            </div>
          </div>
        </div>
        <div className="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div className="p-4 md:p-5">
            <div className="flex items-center gap-x-2">
              <p className="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Vacinas
              </p>
            </div>
            <div className="mt-1 flex items-center gap-x-2">
              <h3 className="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {stats.vaccines}
              </h3>
            </div>
          </div>
        </div>

        <div className="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div className="p-4 md:p-5">
            <div className="flex items-center gap-x-2">
              <p className="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Relatórios
              </p>
            </div>
            <div className="mt-1 flex items-center gap-x-2">
              <h3 className="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {stats.reports}
              </h3>
            </div>
          </div>
        </div>
        <VaccineChart data={data} title="Total de Colaboradores Vacinados por Tipo de Vacina" className='col-span-3' />
      </div>
    </div>
  );
}
