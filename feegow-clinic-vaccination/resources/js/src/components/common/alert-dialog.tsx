import * as Alert from '@radix-ui/react-alert-dialog';
import React from 'react';

interface AlertDialogProps {
  trigger: React.ReactNode;
  title: string;
  description: string;
  cancelText?: string;
  confirmText?: string;
  onConfirm: () => void;
  confirmButtonClassName?: string;
}

export const AlertDialog: React.FC<AlertDialogProps> = ({
  trigger,
  title,
  description,
  cancelText = 'Cancel',
  confirmText = 'Confirm',
  onConfirm,
  confirmButtonClassName = 'bg-red4 text-red11 hover:bg-red5 focus:shadow-red7',
}) => (
  <Alert.Root>
    <Alert.Trigger asChild>
      {trigger}
    </Alert.Trigger>
    <Alert.Portal>
      <Alert.Overlay className="fixed inset-0 bg-blackA6 data-[state=open]:animate-overlayShow" />
      <Alert.Content className="fixed left-1/2 top-1/2 max-h-[85vh] w-[90vw] max-w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-md bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none data-[state=open]:animate-contentShow">
        <Alert.Title className="m-0 text-[17px] font-medium text-mauve12">
          {title}
        </Alert.Title>
        <Alert.Description className="mb-5 mt-[15px] text-[15px] leading-normal text-mauve11">
          {description}
        </Alert.Description>
        <div className="flex justify-end gap-[25px]">
          <Alert.Cancel asChild>
            <button className="inline-flex h-[35px] items-center justify-center rounded bg-mauve4 px-[15px] font-medium leading-none text-mauve11 outline-none hover:bg-mauve5 focus:shadow-[0_0_0_2px] focus:shadow-mauve7">
              {cancelText}
            </button>
          </Alert.Cancel>
          <Alert.Action asChild>
            <button
              onClick={onConfirm}
              className={`px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 ${confirmButtonClassName}`}
            >
              {confirmText}
            </button>
          </Alert.Action>
        </div>
      </Alert.Content>
    </Alert.Portal>
  </Alert.Root>
);
