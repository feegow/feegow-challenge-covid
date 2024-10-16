import { Outlet } from 'react-router-dom';
import Header from '../components/header';
import Footer from '../components/footer';
import Breadcrumb from '../components/breadcrumb';
import Sidebar from '../components/sidebar';

export default function Layout() {
  return (
    <>
      <Header />
      <Breadcrumb />
      <Sidebar />
      <div className="w-full lg:ps-64">
        <div className="p-4 sm:p-6 space-y-4 sm:space-y-6">
          <Outlet />
        </div>
      </div>
      <Footer />
    </>
  );
}
