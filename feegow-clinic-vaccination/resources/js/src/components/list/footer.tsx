export const Footer = ({ children }: { children?: React.ReactNode }) => {
  return (
    <div className="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
      {children}
    </div>
  );
};
