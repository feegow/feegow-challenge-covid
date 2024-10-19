import { useAuth } from '../../context/AuthContext';
import { ActivityButton } from './activity-button';
import { NotificationButton } from './notification-button';
import { MobileSearchButton } from './mobile-search-button';
import { Logo } from './logo';
import { SearchBar } from './search-bar';
import { UserDropdown } from './user-dropdown';

export default function Header() {
  const { APP_NAME } = window as any;
  const { user } = useAuth();

  return (
    <header className="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 lg:ps-[260px] dark:bg-neutral-800 dark:border-neutral-700">
      <nav className="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
        <Logo appName={APP_NAME} />
        <div className="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">
          {/* <SearchBar /> */}
          <div className="flex flex-row items-center justify-end gap-1">
            {/* <MobileSearchButton /> */}
            <NotificationButton />
            <ActivityButton />
            <UserDropdown user={user} />
          </div>
        </div>
      </nav>
    </header>
  );
}
