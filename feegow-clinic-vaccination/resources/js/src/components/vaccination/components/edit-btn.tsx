import { Button } from '@radix-ui/themes';
import { Pencil } from 'lucide-react';
import { forwardRef } from 'react';

const EditButton = forwardRef<HTMLButtonElement, { isSubmitting: boolean }>(({ isSubmitting, ...props }, ref) => {
  return (
    <Button
      ref={ref}
      disabled={isSubmitting}
      className="cursor-pointer w-6 h-6"
      title="Editar"
      variant="soft"
      {...props}
    >
      <Pencil />
    </Button>
  );
});

export { EditButton };
