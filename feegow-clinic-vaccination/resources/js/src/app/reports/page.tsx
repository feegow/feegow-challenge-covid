import { useState } from 'react';

const ReportPage = () => {
  const [loading, setLoading] = useState(false);
  const [reports, setReports] = useState([
    { id: 123, date: '2024-10-15', status: 'Processing', downloadLink: null },
    { id: 124, date: '2024-10-16', status: 'Completed', downloadLink: '/download/124' },
  ]);

  const handleGenerateReport = () => {
    setLoading(true);
    // Trigger the report generation and queue it with Redis
    // After initiating, poll for status updates or handle real-time updates
  };

  return (
    <div className="container mx-auto p-4">
      {/* Header */}
      <header className="p-4 bg-blue-500 text-white text-center">
        <h1 className="text-2xl font-semibold">Unvaccinated Employees Report</h1>
        <p>Generate and track the status of your reports</p>
      </header>

      {/* Generate Report Button */}
      <div className="mt-8 flex justify-center">
        <button
          onClick={handleGenerateReport}
          className="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"
        >
          Generate Unvaccinated Employees Report
        </button>
      </div>

      {/* Loading Spinner */}
      {loading && (
        <div className="mt-4 flex justify-center">
          <div className="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
          <p className="ml-2">Processing your report...</p>
        </div>
      )}

      {/* Report Status List */}
      <div className="mt-10">
        <table className="min-w-full bg-white">
          <thead>
            <tr>
              <th className="py-2 px-4 bg-gray-200">Report ID</th>
              <th className="py-2 px-4 bg-gray-200">Date</th>
              <th className="py-2 px-4 bg-gray-200">Status</th>
              <th className="py-2 px-4 bg-gray-200">Download</th>
            </tr>
          </thead>
          <tbody>
            {reports.map((report) => (
              <tr key={report.id}>
                <td className="border px-4 py-2">{report.id}</td>
                <td className="border px-4 py-2">{report.date}</td>
                <td className={`border px-4 py-2 ${report.status === 'Completed' ? 'text-green-500' : 'text-yellow-500'}`}>
                  {report.status}
                </td>
                <td className="border px-4 py-2">
                  {report.downloadLink ? (
                    <a href={report.downloadLink} className="text-blue-500 underline">
                      Download
                    </a>
                  ) : (
                    <span className="text-gray-500">Unavailable</span>
                  )}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      {/* Notification (show when report is ready) */}
      <div id="notification" className="hidden p-4 bg-green-500 text-white rounded-lg mt-4">
        <p>Your report is ready for download!</p>
      </div>
    </div>
  );
};

export default ReportPage;
