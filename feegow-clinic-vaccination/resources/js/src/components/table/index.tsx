import React from 'react';
import TableHeader from './header';
import TableBody from './body';

interface ListTableProps {
  children: React.ReactNode;
}

const ListTable: React.FC<ListTableProps> = ({ children }) => {
  return <table className="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">{children}</table>;
};

export { ListTable, TableHeader, TableBody };
