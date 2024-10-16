export function Logo({ appName }: { appName: string }) {
  return (
    <div className="me-5 lg:me-0 lg:hidden">
      <a
        className="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
        href="#"
        aria-label="Preline"
      >
        {appName}
      </a>
    </div>
  );
}
