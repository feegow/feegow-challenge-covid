import * as Avatar from '@radix-ui/react-avatar';
import { Menu } from './menu';

export function UserDropdown({ user }: { user: any }) {
  const initials = user?.name
    ?.split(' ')
    .map((n: string) => n[0])
    .join('')
    .slice(0, 2);
  return (
    <div className="hs-dropdown [--placement:bottom-right] relative inline-flex">
      <button
        id="hs-dropdown-account"
        type="button"
        className="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:text-white"
        aria-haspopup="menu"
        aria-expanded="false"
        aria-label="Menu Suspenso"
      >
        <Avatar.Root className="AvatarRoot shrink-0 size-[38px] rounded-full">
          <Avatar.Fallback className="w-full h-full flex items-center justify-center bg-[white] text-[color:#1b2734] text-[15px] leading-none font-medium;">
            {initials}
          </Avatar.Fallback>
        </Avatar.Root>
      </button>
      <Menu user={user} />
    </div>
  );
}
