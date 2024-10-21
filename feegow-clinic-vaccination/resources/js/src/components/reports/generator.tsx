import React, { useState } from 'react';


interface ReportGeneratorProps {
  loading: boolean;
  handleGenerateReport: (params: { anonymizeCpf: boolean }) => void;
}

const ReportGenerator: React.FC<ReportGeneratorProps> = ({
  loading,
  handleGenerateReport,
}) => {
  const [anonymizeCpf, setAnonymizeCpf] = useState(true);

  const handleGenerateReportWithAnonymization = () => {
    handleGenerateReport({ anonymizeCpf });
  };

  return (
    <div className="flex flex-col justify-center items-center mb-8 p-6 bg-white rounded-lg shadow-md relative z-40">
      <h2 className="text-2xl font-semibold mb-4">Gerar Novo Relatório</h2>
      <div className="flex items-center mb-4">
        <input
          id="anonymizeCpf"
          type="checkbox"
          checked={anonymizeCpf}
          onChange={(e) => setAnonymizeCpf(e.target.checked)}
        />
        <label htmlFor="anonymizeCpf" className="ml-2 text-sm font-medium">
          Anonimizar CPF
        </label>
      </div>
      <button
        onClick={handleGenerateReportWithAnonymization}
        disabled={loading}
        className=" bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded cursor-pointer"
      >
        {loading ? 'Gerando...' : 'Gerar Relatório'}
      </button>
    </div>
  );
};

export default ReportGenerator;