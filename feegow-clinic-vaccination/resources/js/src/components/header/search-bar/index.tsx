import { useEffect, useState } from 'react';
import { CloseButton } from './close-button';
import { Shortcut } from './shortcut';
import { useSearchParams } from 'react-router-dom';

export function SearchBar() {
  // eslint-disable-next-line no-unused-vars, @typescript-eslint/no-unused-vars
  const [_, setSearchParams] = useSearchParams();

  const [search, setSearch] = useState('');

  useEffect(() => {
    if (search) {
      setSearchParams({ search });
      setSearch(search);
    }
  }, [search, setSearchParams]);

  return (
    <div className="hidden md:block">
      <div className="relative">
        <div className="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
          <svg
            className="shrink-0 size-4 text-gray-400 dark:text-white/60"
            xmlns="http://www.w3.org/2000/svg"
            width={24}
            height={24}
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth={2}
            strokeLinecap="round"
            strokeLinejoin="round"
          >
            <circle cx={11} cy={11} r={8} />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
        <input
          type="text"
          name='search'
          value={search}
          onChange={(e) => setSearch(e.target.value)}
          className="py-2 ps-10 pe-16 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
          placeholder="Pesquisar"
        />
        <CloseButton />
        <Shortcut />
      </div>
    </div>
  );
}
