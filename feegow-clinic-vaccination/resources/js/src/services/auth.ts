import { LoginFormData } from '../components/auth/login';
import { LoginResponse, User } from '../types';

import { api } from './api';

export const login = async (data: LoginFormData): Promise<LoginResponse> => {
  const response = await api.post<LoginResponse>('/auth/login', data);
  return response.data;
};

export const logout = async (): Promise<void> => {
  await api.post('/auth/logout');
};

export const getUser = async (): Promise<User> => {
  const response = await api.get<User>('/user');
  return response.data;
};
