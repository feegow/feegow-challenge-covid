import { useState, useEffect } from 'react';
import { api } from '@/services/api';
import { PaginatedResponse, Vaccine } from '@/types';

export type VaccineOption = {
  value: number;
  label: string;
}

export function useVaccineOptions() {
  const [vaccineOptions, setVaccineOptions] = useState<VaccineOption[]>([]);

  useEffect(() => {
    const fetchVaccineOptions = async () => {
      try {
        const response = await api.get<PaginatedResponse<Vaccine>>('/vaccines');
        const formattedOptions = response.data.data.map((item: Vaccine) => ({
          value: item.id,
          label: `${item.short_name} - ${item.name}`,
        }));
        setVaccineOptions(formattedOptions);
      } catch (error) {
        console.error('Error fetching vaccine data:', error);
      }
    };

    fetchVaccineOptions();
  }, []);

  return { vaccineOptions };
}