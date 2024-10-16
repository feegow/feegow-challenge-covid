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
