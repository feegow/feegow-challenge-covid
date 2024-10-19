export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string;
  created_at: string;
  updated_at: string;
}

export interface LoginResponse {
  message?: string;
  errors?: Record<string, string[]>;
  success?: boolean;
}


export interface Employee {
  id: number;
  full_name: string;
  cpf: string;
  birth_date: string; // Date in "YYYY-MM-DD" format
  first_dose_date: string; // Date in "YYYY-MM-DD" format
  second_dose_date: string; // Date in "YYYY-MM-DD" format
  third_dose_date: string | null; // Nullable date in "YYYY-MM-DD" format
  vaccine_id: number;
  vaccine_short_name?: string;
  has_comorbidity: boolean;
  created_at: string; // Date-time in ISO format
  updated_at: string; // Date-time in ISO format
}

export interface Links {
  first: string;
  last: string;
  prev: string | null;
  next: string | null;
}

export interface MetaLink {
  url: string | null;
  label: string;
  active: boolean;
}

export interface Meta {
  current_page: number;
  from: number;
  last_page: number;
  links: MetaLink[];
  path: string;
  per_page: number;
  to: number;
  total: number;
}

export interface PaginatedResponse<T> {
  data: T[];
  links: Links;
  meta: Meta;
}
