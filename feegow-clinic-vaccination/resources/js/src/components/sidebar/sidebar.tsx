import { forwardRef } from 'react';

import { Logo } from './logo';
import { Nav } from './navigation/nav';

interface SidebarProps {
  isOpen: boolean; // New prop to manage open state
}

export const Sidebar = forwardRef<HTMLDivElement, SidebarProps>(({ isOpen }, ref) => {
  return (
    <aside
      ref={ref} // Attach the ref to the aside element
      id="application-sidebar"
      className={`hs-overlay [--auto-close:lg] ${isOpen ? 'hs-overlay-open:translate-x-0' : '-translate-x-full'} transition-all duration-300 transform w-64 h-full z-[60] bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 dark:bg-neutral-800 dark:border-neutral-700 fixed`}
      aria-label="Sidebar"
    >
      <div className="flex flex-col h-full">
        <div className="px-6 pt-4">
          <Logo />
        </div>
        <nav className="flex-1 overflow-y-auto p-4">
          <Nav />
        </nav>
      </div>
    </aside>
  );
});