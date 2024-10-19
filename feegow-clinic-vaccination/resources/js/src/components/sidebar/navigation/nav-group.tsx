import { ReactNode } from 'react';

interface NavGroupProps {
  icon: ReactNode;
  label: string;
  children: ReactNode;
}

export function NavGroup({ icon, label, children }: NavGroupProps) {
  return (
    <li className="hs-accordion">
      <button
        type="button"
        className="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200"
      >
        {icon}
        {label}
        <svg
          className="hs-accordion-active:block ms-auto hidden size-4"
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
          <path d="m18 15-6-6-6 6" />
        </svg>
        <svg
          className="hs-accordion-active:hidden ms-auto block size-4"
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
          <path d="m6 9 6 6 6-6" />
        </svg>
      </button>
      <div className="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
        <ul className="pt-2 ps-2">{children}</ul>
      </div>
    </li>
  );
}
