import React, { useMemo } from 'react';

type LoadingRowProps = {
  columns: { name: string; colspan?: number }[];
};

export const LoadingRow: React.FC<LoadingRowProps> = ({ columns }) => {
  const columnsLength = useMemo(() => columns.reduce((total, column) => total + (column.colspan || 1), 0), [columns]);
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