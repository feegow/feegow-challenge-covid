import React from 'react';

interface TableBodyProps<T> {
  data: T[];
  renderRow: (item: T, index: number) => React.ReactNode;
}

function TableBody<T>({ data, renderRow }: TableBodyProps<T>) {
  return (
    <tbody className="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
      {data.map((item, index) => renderRow(item, index))}
    </tbody>
  );
}

export default TableBody;
