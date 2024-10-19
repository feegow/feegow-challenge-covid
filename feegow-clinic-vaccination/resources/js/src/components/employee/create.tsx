import DialogModal from '../dialog';
import { useState } from 'react';
export function EmployeeAdd() {
  const [newEmployee, setNewEmployee] = useState({ name: '', position: '' });

  const handleSave = () => {
    // Logic to save the new employee
    console.log('Saving new employee:', newEmployee);
    // Reset the form
    setNewEmployee({ name: '', position: '' });
  };
  return (
    <DialogModal
      trigger={<button className="btn btn-primary">Add Employee</button>}
      title="Add New Employee"
      description="Enter the details of the new employee."
      onSave={handleSave}
    >
      <div className="space-y-4">
        <div>
          <label htmlFor="name" className="block text-sm font-medium text-gray-700">
            Name
          </label>
          <input
            type="text"
            id="name"
            value={newEmployee.name}
            onChange={(e) => setNewEmployee({ ...newEmployee, name: e.target.value })}
            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          />
        </div>
        <div>
          <label htmlFor="position" className="block text-sm font-medium text-gray-700">
            Position
          </label>
          <input
            type="text"
            id="position"
            value={newEmployee.position}
            onChange={(e) => setNewEmployee({ ...newEmployee, position: e.target.value })}
            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          />
        </div>
      </div>
    </DialogModal>
  );
}
