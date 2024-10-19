import { ReactNode } from 'react';
import { Link, useLocation } from 'react-router-dom';

interface NavItemProps {
  icon: ReactNode;
  label: string;
  href: string;
}

export function NavItem({ icon, label, href }: NavItemProps) {
  const location = useLocation();
  const isActive = location.pathname === href;

  return (
    <li>
      <Link
        className={`flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 ${
          isActive ? 'bg-gray-100 dark:bg-neutral-700' : ''
        } dark:hover:bg-neutral-700 dark:text-neutral-200`}
        to={href}
      >
        {icon}
        {label}
      </Link>
    </li>
  );
}
