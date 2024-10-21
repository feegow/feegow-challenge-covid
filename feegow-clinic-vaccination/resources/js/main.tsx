import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';

import App from './App';

import './bootstrap';
import './preline';
// import './echo';
import 'react-toastify/dist/ReactToastify.css';

function renderApp() {
  const rootElement = document.getElementById('root');

  if (!rootElement) {
    return;
  }

  const doesRootElementHaveChildren = rootElement.hasChildNodes();
  if (doesRootElementHaveChildren) {
    return;
  }

  createRoot(rootElement).render(
    <StrictMode>
      <App />
    </StrictMode>
  );
}

document.addEventListener('DOMContentLoaded', renderApp);
