import React from 'react';

import TableBody from './body';
import TableHeader from './header';

interface ListTableProps {
  children: React.ReactNode;
}

const ListTable: React.FC<ListTableProps> = ({ children }) => {
  return <table className="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">{children}</table>;
};

export { ListTable, TableHeader, TableBody };
