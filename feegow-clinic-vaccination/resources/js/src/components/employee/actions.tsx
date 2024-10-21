import { VaccineOption } from './hooks/useVaccineOptions';

import { Create } from '@/app/employee/create';
// import { MobileSearchButton } from '@/components/header/mobile-search-button';
import { SearchBar } from '@/components/header/search-bar';

type ActionsProps = {
  refreshEmployees: () => void;
  vaccineOptions: VaccineOption[];
};

export const Actions = ({ refreshEmployees, vaccineOptions }: ActionsProps) => {
  return (
    <>
      <SearchBar />
      {/* <MobileSearchButton /> */}
      <Create refreshEmployees={refreshEmployees} vaccineOptions={vaccineOptions} />
    </>
  );
};