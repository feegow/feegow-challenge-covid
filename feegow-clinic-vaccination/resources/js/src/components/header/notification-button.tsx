import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/react';
import { CloudDownloadIcon } from 'lucide-react';
import { useEffect } from 'react';

import { Report } from '@/types';

interface ReportStatusEvent {
  report: Report;
  status: 'failed' | 'completed';
}

export function NotificationButton() {
  useEffect(() => {
    window.Echo.channel('reports')
      .listen('ReportStatus', (event: ReportStatusEvent) => {
        console.log('Job finished:', { ...event });
        // Handle the notification on your frontend
      });
  }, []);

  return (
    <Menu>
      <MenuButton className="size-[38px] relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        <svg
          className="shrink-0 size-4"
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
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <span className="sr-only">Notificações</span>
      </MenuButton>
      <MenuItems
        transition
        anchor="bottom end"
        className="w-52 origin-top-right border bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 p-1 text-sm/6 text-gray-800 transition duration-100 ease-out [--anchor-gap:var(--spacing-1)] focus:outline-none data-[closed]:scale-95 data-[closed]:opacity-0 z-50"
      >
        <MenuItem>
          <button className="group flex w-full items-center gap-2 rounded-lg py-1.5 px-3 data-[focus]:bg-white/10">
            <CloudDownloadIcon className="w-4 h-4" />
            Relatório concluído
            <kbd className="ml-auto hidden font-sans text-xs text-white/50 group-data-[focus]:inline">⌘E</kbd>
          </button>
        </MenuItem>

      </MenuItems>
    </Menu>
  );
}
