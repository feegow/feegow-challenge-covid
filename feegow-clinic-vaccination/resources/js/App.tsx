import { createBrowserRouter, Outlet, RouterProvider, useLocation } from 'react-router-dom';
import { useEffect } from 'react';
import Home from './src/app/home/page';
import Login from './src/app/auth/login/page';
import Layout from './src/app/layout';
import ProtectedRoute from './src/components/protected-route';
import { AuthProvider } from './src/context/AuthContext';
import AuthLayout from './src/app/auth/layout';

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
]);

const App = () => {
  return <RouterProvider router={router} />;
};

export default App;
