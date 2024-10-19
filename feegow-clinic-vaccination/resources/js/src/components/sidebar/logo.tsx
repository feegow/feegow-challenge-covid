export function Logo() {
  const APP_NAME = window.APP_NAME;
  return (
    <a className="text-xl font-semibold rounded-xl focus:outline-none focus:opacity-80" href="#" aria-label={APP_NAME}>
      {APP_NAME}
    </a>
  );
}
