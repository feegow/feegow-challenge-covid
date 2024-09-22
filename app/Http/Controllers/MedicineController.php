<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Medicine;
use App\Helper\TransformDataHelper;
use covid\Application\UseCase\CreateMedicine;
use Covid\Domain\Employee\DTO\MedicineDto;
use Illuminate\Support\Facades\Log;

class MedicineController extends Controller
{
    private TransformDataHelper $helper;
    public function __construct()
    {
        $this->helper = new TransformDataHelper();
    }

    public function index()
    {
        $medicines = Medicine::all();
        return view('medicine.index', compact('medicines'));
    }

    public function create()
    {
        return view('medicine.create');
    }

    public function store(MedicineRequest $request)
    {
        try {
            $validated = $request->validated();
            $medicineDto = new MedicineDto(
                $validated['name'],
                $validated['lot'],
                $this->helper->formatDate($validated['expiration_date'])
            );
            app()->make(CreateMedicine::class)->handle($medicineDto);
        } catch (\DomainException $de) {
            Log::error($de->getMessage(), [$de->getTrace()]);
            return redirect()->back()
                ->with('error', $de->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [$e->getTrace()]);
            return redirect()->back()
                ->with('error', 'Um erro inesperado ocorreu. Por favor, tente novamente.')
                ->withInput();
        }

        return redirect()->route('medicine.index');
    }
}
