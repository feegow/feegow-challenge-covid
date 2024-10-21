import { Bar, YAxis, Legend, XAxis, Tooltip, Cell } from 'recharts';

import { BarChart } from '@/components/common/bar-chart';


type VaccineChartProps = {
  data: Array<{ vaccine: string; total: number; vaccinated_count: number }>;
  title: string;
  className?: string;
};

const generateColors = (length: number) => {
  const baseColors = ['#0CCAC8', '#82ca9d', '#8884d8', '#FFBB28', '#FF8042']; // Add more colors if needed
  return baseColors.slice(0, length).concat(Array(length - baseColors.length).fill('#000')); // Fallback to black if not enough colors
};

export default function VaccineChart({ data, title, className }: VaccineChartProps) {
  const colors = generateColors(new Set(data.map(entry => entry.vaccine)).size);

  const legendPayload = data.map((entry, index) => ({
    value: entry.vaccine,
    type: 'square', // shape for the legend (can be 'line', 'rect', 'square')
    color: colors[index] || '#000',
  }));
  return (
    <BarChart data={data} title={title} layout="horizontal" className={className}>
      <XAxis dataKey="vaccine" type="category" />
      <YAxis dataKey="total" type="number" />
      <Tooltip />
      <Legend payload={legendPayload} />
      <Bar dataKey="total" label="Vacinados" stackId="a">
        {data.map((entry, index) => (
          <Cell key={entry.vaccine} fill={colors[index] || '#000'} />
        ))}
      </Bar>
    </BarChart>
  );
}
