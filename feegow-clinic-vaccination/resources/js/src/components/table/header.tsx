interface TableHeaderProps {
  columns: {
    name: string;
    colspan?: number;
  }[];
}

const TableHeader = ({ columns }: TableHeaderProps) => {
  return (
    <thead>
      <tr>
        {columns.map((column, index) => (
          <th
            key={index}
            className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            colSpan={column.colspan || 1}
          >
            {column.name}
          </th>
        ))}
      </tr>
    </thead>
  );
};

export default TableHeader;
