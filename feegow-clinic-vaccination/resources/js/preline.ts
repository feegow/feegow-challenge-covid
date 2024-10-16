//github.com/htmlstreamofficial/preline/issues/315#issuecomment-2016769186
import 'preline/preline';
import { IStaticMethods } from 'preline/preline';
declare global {
  interface Window {
    HSStaticMethods: IStaticMethods;
  }
}

import { HSStaticMethods } from 'preline';

HSStaticMethods.autoInit();

const observer = new MutationObserver((mutationsList) => {
  for (const mutation of mutationsList) {
    HSStaticMethods.autoInit();
  }
});

observer.observe(document.body, {
  attributes: true,
  subtree: true,
  childList: true,
  characterData: true,
});
