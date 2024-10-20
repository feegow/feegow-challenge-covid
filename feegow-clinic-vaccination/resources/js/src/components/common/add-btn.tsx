import { Button } from '@radix-ui/themes';
import { Plus } from 'lucide-react';
import { forwardRef } from 'react';

const AddButton = forwardRef<HTMLButtonElement, { isSubmitting: boolean }>(({ isSubmitting, ...props }, ref) => {
  return (
    <Button
      ref={ref}
      disabled={isSubmitting}
      className="py-2 px-3 inline-flex cursor-pointer items-center gap-x-2 text-md font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
      {...props}
    >
      <Plus size={16} />
      Adicionar
    </Button>
  );
});

export { AddButton };
