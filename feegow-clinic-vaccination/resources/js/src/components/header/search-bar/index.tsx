import { useEffect, useState, useCallback } from 'react';
import { CloseButton } from './close-button';
import { Shortcut } from './shortcut';
import { useSearchParams } from 'react-router-dom';
import debounce from 'lodash.debounce';
import { Button } from '@radix-ui/themes';
import { X } from 'lucide-react';

export function SearchBar() {
  const [, setSearchParams] = useSearchParams();

  const [search, setSearch] = useState('');

  // Debounced function to update search params
  const debouncedSetSearchParams = useCallback(
    debounce((value: string) => {
      if (value) {
        setSearchParams({ search: value });
      } else {
        setSearchParams({});
      }
    }, 300),
    [setSearchParams]
  );

  useEffect(() => {
    debouncedSetSearchParams(search);
    // Cancel the debounce on cleanup
    return () => debouncedSetSearchParams.cancel();
  }, [search, debouncedSetSearchParams]);

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
        {search && (
          <div className="absolute inset-y-0 end-0 flex items-center z-20 pe-3 text-gray-400">
            <Button onClick={() => setSearch('')} variant="ghost" className='cursor-pointer' title='Limpar pesquisa' size="1">
              <X size={16} />
            </Button>
          </div>
        )}
      </div>
    </div>
  );
}