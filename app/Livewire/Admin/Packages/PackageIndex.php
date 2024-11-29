<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin.master')]
class PackageIndex extends Component
{
    use WithPagination;

    public $model_id;
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';
    public $paginate = 10;
    public $search = "";
    public $sections = null;
    public $selectedSection = null;
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    public $isOpen = 0;
    protected $listeners = ['deleteConfirmed'=>'delete'];

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $model = Package::query()->where('name','like','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->withTrashed()
            ->paginate($this->paginate)->withQueryString();
        return view('livewire.admin.packages.package-index',compact('model'));
    }
    public function alertSuccess($rel)
    {
        $this->dispatch('alert',
            ['types' => 'success',  'message' => $rel]);
    }
    public function alertDanger($rel)
    {
        $this->dispatch('alert',
            ['types' => 'error',  'message' => $rel]);
    }
    public function deleteConfirmation($id)
    {
        $this->model_id = $id;
        $this->dispatch('show-delete-confirm');
    }
    public function delete()
    {
        try{
            $item =  Package::findOrFail($this->model_id);
            $item->delete();
            $this->checked = array_diff($this->checked, [$this->model_id]);
            $this->alertSuccess('Image Deleted Successfully');
            $this->dispatch('delete-model');
            return redirect()->to(route('admin.packages.index'));
        }catch(\Exception $e){
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
    public function deleteOne($id)
    {
        try{
            $item =  Package::findOrFail($id);
            $item->delete();
            $this->alertSuccess('Deleted Successfully');
            $this->dispatch('delete-model');
            return redirect()->to(route('admin.packages.index'));
        }catch(\Exception $e){
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }

    }
    public function updatedSelectAll($value)
    {
        if ($value)
        {
            $this->checked = Package::pluck('id')->map(fn ($item) => (string) $item)->toArray();
        }else{
            $this->checked = [];
        }
//        $this->selectAll = true;
    }
    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }
    public function updatedChecked()
    {
        $this->selectAll = false;
    }
    public function deleteRecords()
    {
        try{
            Package::whereKey($this->checked)->delete();
            $this->checked = [];
            $this->selectAll = false;
            $this->selectPage = false;
            $this->alertSuccess('Selected Records were deleted Successfully');
            //        session()->flash('info', 'Selected Records were deleted Successfully');
        }catch(\Exception $e){
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
    public function restoreDeleted($id)
    {
        try {
            $deletedRecord = Package::onlyTrashed()->find($id);
            if ($deletedRecord) {
                $deletedRecord->restore();
            }
            $this->alertSuccess('Selected Records were Restored Successfully');
        } catch (\Exception $e) {
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
    public function forceDelete($id)
    {
        try {
            $deletedRecord = Package::withTrashed()->find($id);
            if ($deletedRecord) {
                $deletedRecord->forceDelete();
            }
            $this->alertSuccess('Selected Records were Force Deleted Successfully');
        } catch (\Exception $e) {
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
    public function setSortBy($sortBy)
    {
        if ($this->sortDirection == 'asc')
        {
            $this->sortDirection = 'desc';
        }else{
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $sortBy;
    }
}
