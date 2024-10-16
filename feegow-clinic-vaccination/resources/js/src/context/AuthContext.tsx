import React, { createContext, useState, useContext, useEffect } from 'react';
import axios from 'axios';
import { api } from '../services/api';
import { login } from '../services/auth';
import { User } from '../types';
import { LoginResponse } from '../types';
import { LoginFormData } from '../components/auth/login';
import { router } from '../../App';

interface AuthContextType {
  user: User | null;
  signIn: (userData: LoginFormData) => Promise<LoginResponse>;
  logout: () => void;
  isLoggedIn: boolean;
}

const AuthContext = createContext<AuthContextType | null>(null);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const isLoggedIn = !!user;

  useEffect(() => {
    // Get CSRF token at application start
    axios.get('/sanctum/csrf-cookie').then(() => {});
    getUser();
  }, []);

  useEffect(() => {
    if (isLoggedIn) {
      router.navigate('/', { replace: true });
    }
  }, [isLoggedIn]);

  const getUser = async () => {
    try {
      const response = await api.get<User>('/user');
      setUser(response.data);
    } catch (error) {
      // do nothing
    }
  };

  const signIn = async (userData: LoginFormData) => {
    const response = await login(userData);
    if (response.success) {
      await getUser();
    }
    return response;
  };
  const logout = () => setUser(null);

  return <AuthContext.Provider value={{ user, signIn, logout, isLoggedIn }}>{children}</AuthContext.Provider>;
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
