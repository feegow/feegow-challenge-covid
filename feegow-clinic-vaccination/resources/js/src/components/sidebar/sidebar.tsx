import { Logo } from './logo';
import { Nav } from './navigation/nav';

export function Sidebar() {
  return (
    <aside
      id="application-sidebar"
      className="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0
        -translate-x-full transition-all duration-300 transform fixed
        w-64 h-full z-[60] bg-white border-e border-gray-200
        lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
        dark:bg-neutral-800 dark:border-neutral-700"
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
}
