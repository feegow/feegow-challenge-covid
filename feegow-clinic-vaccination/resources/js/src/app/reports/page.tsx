import { FileDown, Trash } from 'lucide-react';
import { useCallback, useEffect, useState } from 'react';
import { toast } from 'react-toastify';

import { AlertDialog } from '@/components/common/alert-dialog';
import { useAuth } from '@/context/AuthContext';
import { formatDate } from '@/lib/dayjs';
import { api } from '@/services/api';
import { PaginatedResponse } from '@/types';

interface Report {
  id: number;
  type: string;
  status: string;
  file_path: string | null;
  user_id: number;
  completed_at: string | null;
  date: string | null;
  download_link: string | null;
  created_at: string;
  updated_at: string;
}

enum ReportStatus {
  Completed = 'completed',
  Processing = 'processing',
  Cancelled = 'cancelled',
}

const reportStatusConfig: Record<ReportStatus, { text: string; color: string }> = {
  [ReportStatus.Completed]: { text: 'Concluído', color: 'text-green-500' },
  [ReportStatus.Processing]: { text: 'Processando', color: 'text-yellow-500' },
  [ReportStatus.Cancelled]: { text: 'Cancelado', color: 'text-red-500' },
};

enum ReportType {
  UnvaccinatedEmployees = 'unvaccinated_employees',
}

const reportTypeTranslations: Record<ReportType, string> = {
  [ReportType.UnvaccinatedEmployees]: 'Funcionários não vacinados',
};

const ReportPage = () => {
  const { user } = useAuth();
  const [loading, setLoading] = useState(false);
  const [reports, setReports] = useState<Report[]>([]);
  const [anonymizeCpf, setAnonymizeCpf] = useState(true);

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
    fetchReports();
  }, [fetchReports]);

  const handleGenerateReport = async () => {
    setLoading(true);
    try {
      const response = await api.post<Report>('/reports', {
        type: ReportType.UnvaccinatedEmployees,
        status: 'processing',
        anonymize_cpf: anonymizeCpf,
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
      <header className="p-4 bg-blue-500 text-white text-center">
        <h1 className="text-2xl font-semibold">Relatório de Funcionários Não Vacinados</h1>
        <p>Gere e acompanhe o status dos seus relatórios</p>
      </header>

      <div className="mt-8 flex justify-center">
        <button
          onClick={handleGenerateReport}
          className="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"
          disabled={loading}
        >
          {loading ? 'Gerando...' : 'Gerar Relatório de Funcionários Não Vacinados'}
        </button>
        <label htmlFor="anonymize-cpf" className="ml-2">
          <input
            type="checkbox"
            className="mr-2"
            id="anonymize-cpf"
            checked={anonymizeCpf}
            onChange={() => setAnonymizeCpf(!anonymizeCpf)}
          />
          Anonimizar CPF
        </label>
      </div>

      {loading && (
        <div className="mt-4 flex justify-center">
          <div className="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
          <p className="ml-2">Processando seu relatório...</p>
        </div>
      )}

      <div className="mt-10">
        <table className="min-w-full bg-white">
          <thead>
            <tr>
              <th className="py-2 px-4 bg-gray-200">ID do Relatório</th>
              <th className="py-2 px-4 bg-gray-200">Tipo</th>
              <th className="py-2 px-4 bg-gray-200">Data</th>
              <th className="py-2 px-4 bg-gray-200">Status</th>
              <th className="py-2 px-4 bg-gray-200">Download</th>
              <th className="py-2 px-4 bg-gray-200">Ações</th>
            </tr>
          </thead>
          <tbody>
            {reports.length > 0 ? (
              reports.map((report) => {
                const { text: statusText, color: statusColor } = getReportStatusInfo(report.status);
                return (
                  <tr key={report.id}>
                    <td className="border px-4 py-2">{report.id}</td>
                    <td className="border px-4 py-2"> {reportTypeTranslations[report.type as ReportType] || report.type}</td>
                    <td className="border px-4 py-2">{formatDate(report.created_at, isoDateTimeFormat)}</td>
                    <td className={`border px-4 py-2 ${statusColor}`}>
                      {statusText}
                    </td>
                    <td className="border px-4 py-2">
                      {report.download_link ? (
                        <a href={report.download_link} className="text-blue-500 underline">
                          <FileDown />
                        </a>
                      ) : (
                        <span className="text-gray-500">Indisponível</span>
                      )}
                    </td>
                    <td className="border px-4 py-2">
                      <AlertDialog
                        trigger={
                          <button
                            className="text-red-500 hover:text-red-700 cursor-pointer"
                            title="Excluir relatório"
                          >
                            <Trash />
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
                <td colSpan={6} className="text-center py-4">
                  Nenhum relatório encontrado
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ReportPage;