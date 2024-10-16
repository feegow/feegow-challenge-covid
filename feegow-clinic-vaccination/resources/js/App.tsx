import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import Home from './src/app/home/page';
import Login from './src/app/auth/login/page';
import Layout from './src/app/layout';
import ProtectedRoute from './src/components/protected-route';
import { AuthProvider } from './src/context/AuthContext';
import AuthLayout from './src/app/auth/layout';

export const router = createBrowserRouter([
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
]);

const App = () => (
  <AuthProvider>
    <RouterProvider router={router} />
  </AuthProvider>
);

export default App;
