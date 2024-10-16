import { Outlet } from 'react-router-dom';

export default function AuthLayout() {
  return (
    <div className="bg-[#08C3D7] flex h-screen items-center py-16 dark:bg-neutral-800">
      <div className="w-full max-w-md mx-auto p-6">
        <Outlet />
      </div>
    </div>
  );
}
