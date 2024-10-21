import { BarChart as RechartsBarChart, ResponsiveContainer } from 'recharts';

import { cn } from '@/lib/cn';

type BarChartProps = {
  data: Array<{ vaccine: string; total: number; vaccinated_count: number }>;
  title: string;
  layout?: 'vertical' | 'horizontal';
  className?: string;
  children?: React.ReactNode;
};

export const BarChart = ({ data, title, layout = 'vertical', className, children }: BarChartProps) => {
  return (
    <div className={cn('w-full h-96 p-4 border border-gray-200 bg-white shadow-lg rounded-md', className)}>
      <h2 className="text-xl font-bold mb-4">{title}</h2>
      <ResponsiveContainer width="100%" height="100%">
        <RechartsBarChart data={data} layout={layout} margin={{ top: 20, right: 30, left: 20, bottom: 5 }}>
          {children}
        </RechartsBarChart>
      </ResponsiveContainer>
    </div>
  );
};