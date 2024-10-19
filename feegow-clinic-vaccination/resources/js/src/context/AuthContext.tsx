import React, { createContext, useState, useContext, useEffect } from 'react';
import axios from 'axios';
import { api } from '../services/api';
import { login, logout } from '../services/auth';
import { User } from '../types';
import { LoginResponse } from '../types';
import { LoginFormData } from '../components/auth/login';
import { router } from '../../App';

interface AuthContextType {
  user: User | null;
  signIn: (userData: LoginFormData) => Promise<LoginResponse>;
  signOut: () => Promise<void>;
  isLoggedIn: boolean;
}

const AuthContext = createContext<AuthContextType | null>(null);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const isLoggedIn = !!user;

  useEffect(() => {
    // Get CSRF token at application start
    axios.get('/sanctum/csrf-cookie').then(() => { });
    getUser();
  }, []);


  useEffect(() => {
    storeLastVisitedPage();
    if (isLoggedIn) {
      const lastVisitedPage = localStorage.getItem('lastVisitedPage') || '/';
      router.navigate(lastVisitedPage, { replace: true });
      localStorage.removeItem('lastVisitedPage'); // Clear the stored page after redirection
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
      const lastVisitedPage = localStorage.getItem('lastVisitedPage') || '/';
      router.navigate(lastVisitedPage, { replace: true });
      localStorage.removeItem('lastVisitedPage');
    }
    return response;
  };

  const signOut = async () => {
    try {
      await logout();
      setUser(null);
      router.navigate('/auth/login', { replace: true });
    } catch (error) {
      console.error('Logout failed:', error);
    }
  };

  const storeLastVisitedPage = () => {
    const currentPath = window.location.pathname + window.location.search;
    console.log({
      currentPath,
      search: window.location.search,
      pathname: window.location.pathname,
    });
    if (currentPath !== '/auth/login' && currentPath !== '/auth/register') {
      localStorage.setItem('lastVisitedPage', currentPath);
    }
  };

  return <AuthContext.Provider value={{ user, signIn, signOut, isLoggedIn }}>{children}</AuthContext.Provider>;
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
