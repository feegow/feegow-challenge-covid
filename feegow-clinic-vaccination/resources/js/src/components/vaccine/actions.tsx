import React from 'react';

import { Create } from '@/app/vaccine/create';
import { MobileSearchButton } from '@/components/header/mobile-search-button';
import { SearchBar } from '@/components/header/search-bar';

type ActionsProps = {
  refreshVaccines: () => void;
};

export const Actions: React.FC<ActionsProps> = ({ refreshVaccines }) => {
  return (
    <>
      <SearchBar />
      <MobileSearchButton />
      <Create refreshVaccines={refreshVaccines} />
    </>
  );
};