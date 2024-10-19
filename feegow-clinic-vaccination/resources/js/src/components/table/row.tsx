export default function TableRow({ data }) {
  return (
    <tr>
      <td className="h-px w-auto whitespace-nowrap">
        <div className="px-6 py-2 flex items-center gap-x-3">
          <span className="text-sm text-gray-600 dark:text-neutral-400">{data.rank}.</span>
          <a className="flex items-center gap-x-2" href="#">
            <img src={data.flag} alt={`${data.country} flag`} className="size-4" />
            <span className="text-sm text-blue-600 decoration-2 hover:underline dark:text-blue-500">
              {data.country}
            </span>
          </a>
        </div>
      </td>
      <td className="h-px w-auto whitespace-nowrap">
        <div className="px-6 py-2">
          <span className="font-semibold text-sm text-gray-800 dark:text-neutral-200">{data.users}</span>
          <span className="text-xs text-gray-500 dark:text-neutral-500">({data.usersPercentage})</span>
        </div>
      </td>
      {/* Add other table cells here */}
    </tr>
  );
}
