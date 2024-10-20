import { MenuItem } from '@/components/header/user-dropdown/menu-item';
import { useAuth } from '@/context/AuthContext';
import { User } from '@/types';

type MenuProps = {
  user: User;
};

export function Menu({ user }: MenuProps) {
  const { signOut } = useAuth();

  return (
    <div
      className="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
      role="menu"
      aria-orientation="vertical"
      aria-labelledby="hs-dropdown-account"
    >
      <div className="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
        <p className="text-sm text-gray-500 dark:text-neutral-500">Conectado como</p>
        <p className="text-sm font-medium text-gray-800 dark:text-neutral-200">{user?.email}</p>
      </div>
      <div className="p-1.5 space-y-0.5">
        <MenuItem
          href="#"
          icon="logout"
          text="Sair"
          onClick={async (e) => {
            e.preventDefault();
            await signOut();
          }}
        />
      </div>
    </div>
  );
}
