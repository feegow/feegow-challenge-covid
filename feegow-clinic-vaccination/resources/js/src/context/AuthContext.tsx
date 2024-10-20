import axios from 'axios';
import React, { createContext, useState, useContext, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';

import { LoginFormData } from '../components/auth/login';
import { api } from '../services/api';
import { login, logout } from '../services/auth';
import { IntendedUrlResponse, User } from '../types';
import { LoginResponse } from '../types';

interface AuthContextType {
  user: User | null;
  signIn: (userData: LoginFormData) => Promise<LoginResponse>;
  signOut: () => Promise<void>;
  isLoggedIn: boolean;
  isLoading: boolean;
  getIntendedUrl: () => Promise<string>;
}

const AuthContext = createContext<AuthContextType | null>(null);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const isLoggedIn = !!user;
  const navigate = useNavigate();
  const location = useLocation();

  useEffect(() => {
    // Get CSRF token at application start
    axios.get('/sanctum/csrf-cookie').then(() => {});
    getUser();
  }, []);

  const getIntendedUrl = async () => {
    try {
      const response = await axios.post('/intended-url', {
        returnUrl: window.location.pathname,
      });
      return response.data.url;
    } catch (error) {
      console.error('Error getting intended URL:', error);
      return null;
    }
  };

  const getUser = async () => {
    setIsLoading(true);
    try {
      const response = await api.get<User>('/user');
      setUser(response.data);
    } catch (error) {
      setUser(null);
    } finally {
      setIsLoading(false);
    }
  };

  useEffect(() => {
    if (!isLoading) {
      if (isLoggedIn && location.pathname.startsWith('/auth/')) {
        const params = new URLSearchParams(location.search);
        const returnUrl = params.get('returnUrl');
        if (returnUrl) {
          const [pathname, search] = returnUrl.split('?');
          navigate(pathname, { replace: true, state: { from: 'login' } });
          if (search) {
            navigate({ search }, { replace: true });
          }
        } else {
          navigate('/', { replace: true });
        }
      } else if (!isLoggedIn && !location.pathname.startsWith('/auth/')) {
        const currentFullPath = `${location.pathname}${location.search}`;
        navigate(`/auth/login?returnUrl=${encodeURIComponent(currentFullPath)}`, { replace: true });
      }
    }
  }, [isLoggedIn, isLoading, location.pathname, location.search, navigate]);

  const signIn = async (userData: LoginFormData) => {
    const response = await login(userData);
    if (response.success) {
      await getUser();
      const params = new URLSearchParams(location.search);
      const returnUrl = params.get('returnUrl');
      if (returnUrl) {
        const [pathname, search] = returnUrl.split('?');
        navigate(pathname, { replace: true, state: { from: 'login' } });
        if (search) {
          navigate({ search }, { replace: true });
        }
      } else {
        navigate('/', { replace: true });
      }
    }
    return response;
  };

  const signOut = async () => {
    try {
      await logout();
      setUser(null);
      navigate('/auth/login', { replace: true });
    } catch (error) {
      console.error('Logout failed:', error);
    }
  };

  if (isLoading) {
    return <div>Carregando...</div>;
  }

  return (
    <AuthContext.Provider value={{ user, signIn, signOut, isLoggedIn, isLoading, getIntendedUrl }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
