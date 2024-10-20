import { createRoot } from 'react-dom/client';
import App from './App';
import './bootstrap';
import './preline';
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

  createRoot(rootElement).render(<App />);
}

document.addEventListener('DOMContentLoaded', renderApp);
