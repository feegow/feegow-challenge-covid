import { FileDown, Trash } from 'lucide-react';
import { useCallback, useEffect, useState } from 'react';
import { toast } from 'react-toastify';

import { AlertDialog } from '@/components/common/alert-dialog';
import ReportGenerator from '@/components/reports/generator';
import { useAuth } from '@/context/AuthContext';
import { formatDate } from '@/lib/dayjs';
import { api } from '@/services/api';
import { PaginatedResponse, ReportStatus, ReportType } from '@/types';

const reportStatusConfig: Record<ReportStatus, { text: string; color: string }> = {
  [ReportStatus.Completed]: { text: 'Concluído', color: 'text-green-500' },
  [ReportStatus.Processing]: { text: 'Processando', color: 'text-yellow-500' },
  [ReportStatus.Canceled]: { text: 'Cancelado', color: 'text-red-500' },
};

const reportTypeTranslations: Record<ReportType, string> = {
  [ReportType.UnvaccinatedEmployees]: 'Funcionários não vacinados',
};

const ReportPage = () => {
  const { user } = useAuth();
  const [loading, setLoading] = useState(false);
  const [reports, setReports] = useState<Report[]>([]);

  const isoDateTimeFormat = 'YYYY-MM-DDTHH:mm:ss.SSSSSS[Z]';

  const fetchReports = useCallback(async () => {
    try {
      const response = await api.get<PaginatedResponse<Report>>('/reports');
      setReports(response.data.data);
    } catch (error) {
      toast.error('Erro ao buscar relatórios');
    }
  }, []);

  useEffect(() => {
    fetchReports(); // Initial fetch
    const intervalId = setInterval(fetchReports, 5000); // Poll every 5 seconds

    return () => clearInterval(intervalId); // Cleanup on unmount
  }, [fetchReports]);

  const handleGenerateReport = async (params: { anonymizeCpf: boolean }) => {
    setLoading(true);
    try {
      const response = await api.post<Report>('/reports', {
        type: ReportType.UnvaccinatedEmployees,
        status: 'processing',
        anonymize_cpf: params.anonymizeCpf,
        user_id: user ? user.id : null,
      });

      if (response.status === 201) {
        toast.success('Relatório iniciado com sucesso');
        fetchReports();
      } else {
        throw new Error('Unexpected response status');
      }
    } catch (error) {
      toast.error('Erro ao gerar relatório');
    } finally {
      setLoading(false);
    }
  };

  const handleDeleteReport = async (reportId: number) => {
    try {
      await api.delete(`/reports/${reportId}`);
      toast.success('Relatório excluído com sucesso');
      fetchReports();
    } catch (error) {
      toast.error('Erro ao excluir relatório');
    }
  };

  const getReportStatusInfo = (status: string) => {
    return reportStatusConfig[status as ReportStatus] || { text: status, color: 'text-gray-500' };
  };

  return (
    <div className="container mx-auto p-4">
      <div className="relative isolate px-6 pt-14 lg:px-8">
        <div className="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
          <div className="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style={{ clipPath: 'polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)' }}></div>
        </div>
        <div className="mx-auto max-w-2xl py-8 sm:py-12 lg:py-14">
          <div className="text-center">
            <h1 className="text-balance text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Relatório de Funcionários Não Vacinados</h1>
            <p className="mt-6 text-lg leading-8 text-gray-600">Gere e acompanhe o status dos seus relatórios</p>
          </div>
        </div>
        <div className="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
          <div className="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style={{ clipPath: 'polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)' }}></div>
        </div>
      </div>

      <ReportGenerator
        loading={loading}
        handleGenerateReport={handleGenerateReport}
      />

      {
        loading && (
          <div className="mt-4 flex justify-center">
            <div className="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
            <p className="ml-2">Processando seu relatório...</p>
          </div>
        )
      }

      <div className="mt-10 flow-root">
        <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
              <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                  <tr className="text-center">
                    <th scope="col" className="py-3.5 pl-4 pr-3  text-sm font-semibold text-gray-900 sm:pl-6">ID do Relatório</th>
                    <th scope="col" className="px-3 py-3.5  text-sm font-semibold text-gray-900">Tipo</th>
                    <th scope="col" className="px-3 py-3.5  text-sm font-semibold text-gray-900">Data</th>
                    <th scope="col" className="px-3 py-3.5  text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" className="px-3 py-3.5  text-sm font-semibold text-gray-900">Download</th>
                    <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">Ações</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                  {reports.length > 0 ? (
                    reports.map((report, reportIdx) => {
                      const { text: statusText, color: statusColor } = getReportStatusInfo(report.status);
                      const pairBackground = reportIdx % 2 === 0 ? undefined : 'bg-gray-50';
                      return (
                        <tr key={report.id} className={`${pairBackground} text-center`}>
                          <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{report.id}</td>
                          <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{reportTypeTranslations[report.type as ReportType] || report.type}</td>
                          <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{formatDate(report.created_at, isoDateTimeFormat)}</td>
                          <td className={`whitespace-nowrap px-3 py-4 text-sm ${statusColor}`}>
                            {statusText}
                          </td>
                          <td className="whitespace-nowrap px-3 py-4 text-centertext-sm text-gray-500">
                            {report.download_link ? (
                              <a href={report.download_link} className="text-indigo-600 hover:text-indigo-900 w-5 h-5 block mx-auto">
                                <FileDown className="h-5 w-5" />
                              </a>
                            ) : (
                              <span className="text-gray-400">Indisponível</span>
                            )}
                          </td>
                          <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                            <AlertDialog
                              trigger={
                                <button
                                  className="text-red-600 hover:text-red-900 w-5 h-5 block mx-auto"
                                  title="Excluir relatório"
                                >
                                  <Trash className="h-5 w-5" />
                                </button>
                              }
                              title="Excluir Relatório"
                              description="Tem certeza que deseja excluir este relatório? Esta ação não pode ser desfeita."
                              cancelText="Cancelar"
                              confirmText="Excluir"
                              onConfirm={() => handleDeleteReport(report.id)}
                              confirmButtonClassName="bg-red-600 hover:bg-red-700 text-white"
                            />
                          </td>
                        </tr>
                      );
                    })
                  ) : (
                    <tr>
                      <td colSpan={6} className="py-4 text-center text-sm text-gray-500">
                        Nenhum relatório encontrado
                      </td>
                    </tr>
                  )}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div >
  );
};

export default ReportPage;