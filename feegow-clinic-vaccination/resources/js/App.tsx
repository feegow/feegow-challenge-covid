import { createBrowserRouter, Outlet, RouterProvider, useLocation } from 'react-router-dom';
import { useEffect } from 'react';
import Home from './src/app/home/page';
import Login from './src/app/auth/login/page';
import Layout from './src/app/layout';
import ProtectedRoute from './src/components/protected-route';
import { AuthProvider } from './src/context/AuthContext';
import AuthLayout from './src/app/auth/layout';
import NotFound from './src/components/not-found';
import { Create as EmployeeCreate } from './src/components/employee/create';
import { EmployeeList } from './src/components/employee';
import { VaccinationAdd } from './src/components/vaccination';
import { Vaccination } from './src/components/vaccination';
import { ToastContainer } from 'react-toastify';

const Root = () => {
  const location = useLocation();

  useEffect(() => {
    window.HSStaticMethods.autoInit();
  }, [location.pathname]);

  return (
    <AuthProvider>
      <Outlet />
    </AuthProvider>
  );
};

export const router = createBrowserRouter([
  {
    path: '/',
    element: <Root />,
    children: [
      {
        path: '/',
        element: (
          <ProtectedRoute>
            <Layout />
          </ProtectedRoute>
        ),
        children: [
          {
            path: '/',
            element: <Home />,
          },
          {
            path: '/colaboradores',
            element: <EmployeeList />,
            children: [
              {
                path: '/colaboradores/adicionar',
                element: <EmployeeCreate />,
              },
            ],
          },
          {
            path: '/vacinas',
            element: <Vaccination />,
            children: [
              {
                path: '/vacinas/adicionar',
                element: <VaccinationAdd />,
              },
            ],
          },
        ],
      },
      {
        path: '/auth',
        element: <AuthLayout />,
        children: [
          {
            path: 'login',
            element: <Login />,
          },
        ],
      },
    ],
  },
  {
    path: '*',
    element: <NotFound />,
  },
]);

const App = () => {
  return (
    <>
      <RouterProvider router={router} />
      <ToastContainer style={{ zIndex: 9999 }} />
    </>
  );
};

export default App;
