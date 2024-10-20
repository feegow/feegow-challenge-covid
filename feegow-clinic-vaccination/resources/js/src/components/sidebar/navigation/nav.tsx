import { CloudDownload, Syringe, Users, House } from 'lucide-react';

import { NavItem } from './nav-item';

export function Nav() {
  return (
    <ul className="space-y-2">
      <NavItem icon={<House size={20} />} label="Dashboard" href="/" />
      <NavItem icon={<Users size={20} />} label="Colaboradores" href="/colaboradores" />
      <NavItem icon={<Syringe size={20} />} label="Vacinas" href="/vacinas" />
      <NavItem icon={<CloudDownload size={20} />} label="Relatórios" href="/relatorios" />
    </ul>
  );
}
