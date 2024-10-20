import { Syringe } from 'lucide-react';

import { HomeIcon, UsersIcon } from '../icons';

import { NavItem } from './nav-item';

export function Nav() {
  return (
    <ul className="space-y-2">
      <NavItem icon={<HomeIcon />} label="Dashboard" href="/" />
      <NavItem icon={<UsersIcon />} label="Ver colaboradores" href="/colaboradores" />
      <NavItem icon={<Syringe />} label="Ver vacinas" href="/vacinas" />
    </ul>
  );
}
