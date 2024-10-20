import React from 'react';

interface TableBodyProps<T> {
  children: React.ReactNode;
}

function TableBody<T>({ children }: TableBodyProps<T>) {
  return (
    <tbody className="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">{children}</tbody>
  );
}

export default TableBody;
