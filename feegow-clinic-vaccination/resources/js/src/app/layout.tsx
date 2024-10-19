import { Outlet } from 'react-router-dom';
import Header from '../components/header';
import Footer from '../components/footer';
import Breadcrumb from '../components/breadcrumb';
import Sidebar from '../components/sidebar';

export default function Layout() {
  return (
    <div className="flex flex-col min-h-screen">
      <Header />
      <div className="flex-grow flex">
        <Sidebar />
        <div className="w-full lg:ps-64 flex flex-col">
          <Breadcrumb />
          <main className="flex-grow p-4 sm:p-6">
            <Outlet />
          </main>
        </div>
      </div>
      <Footer />
    </div>
  );
}
