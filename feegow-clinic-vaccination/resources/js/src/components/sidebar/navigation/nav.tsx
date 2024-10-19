import { NavItem } from './nav-item';
import { NavGroup } from './nav-group';
import { SubNavItem } from './sub-nav-item';
import { HomeIcon, UsersIcon } from '../icons';
import { Plus, List, Syringe } from 'lucide-react';

export function Nav() {
  return (
    <ul className="space-y-2">
      <NavItem icon={<HomeIcon />} label="Dashboard" href="/" />
      <NavGroup icon={<UsersIcon />} label="Colaboradores">
        <SubNavItem icon={<List size={16} />} href="/colaboradores" label="Ver colaboradores" />
        <SubNavItem icon={<Plus size={16} />} href="/colaboradores/adicionar" label="Adicionar colaborador" />
      </NavGroup>
      <NavGroup icon={<Syringe size={16} />} label="Vacinas">
        <SubNavItem icon={<List size={16} />} href="/vacinas" label="Ver vacinas" />
        <SubNavItem icon={<Plus size={16} />} href="/vacinas/adicionar" label="Adicionar vacina" />
      </NavGroup>
    </ul>
  );
}
