import { useEffect, useRef, useState } from 'react';
import { Outlet } from 'react-router-dom';

import Breadcrumb from '@/components/breadcrumb';
import Footer from '@/components/footer';
import Header from '@/components/header';
import Sidebar from '@/components/sidebar';

export default function Layout() {

  const [isSidebarOpen, setSidebarOpen] = useState(false);
  const sidebarRef = useRef<HTMLDivElement>(null);

  const toggleSidebar = () => {
    setSidebarOpen(prev => !prev);
  };

  // Close sidebar on click outside
  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (sidebarRef.current && !sidebarRef.current.contains(event.target as Node)) {
        setSidebarOpen(false); // Close sidebar if clicked outside
      }
    };

    document.addEventListener('mousedown', handleClickOutside); // Add event listener
    return () => {
      document.removeEventListener('mousedown', handleClickOutside); // Cleanup listener
    };
  }, [sidebarRef]);

  return (
    <div className="flex flex-col min-h-screen">
      <Header />
      <div className="flex-grow flex">
        <Sidebar ref={sidebarRef} isOpen={isSidebarOpen} />
        <div className="w-full lg:ps-64 flex flex-col">
          <Breadcrumb isOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
          <main className="flex-grow p-4 sm:p-6">
            <Outlet />
          </main>
        </div>
        {/* Backdrop for mobile */}
        {isSidebarOpen && (
          <div
            className="fixed inset-0 bg-black bg-opacity-50 z-40" // Backdrop styles
            onClick={() => setSidebarOpen(false)} // Close sidebar on backdrop click
          />
        )}
      </div>
      <Footer />
    </div>
  );
}
