<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Support\Sortable;
use App\Support\WithConfirmation;
use Livewire\WithPagination;
use Livewire\Component;

class UsersTable extends Component
{
  use WithPagination, Sortable, WithConfirmation;

  public int $perPage;
  public array $orderable;
  public string $search = '';

  public array $selected = [];
  public array $paginationOptions;

  protected $queryString = [
    'search' => [
      'except' => '',
    ],
    'sortBy' => [
      'except' => 'id',
    ],
    'sortDirection' => [
      'except' => 'desc',
    ],
  ];

  public function mount()
  {
      $this->sortBy            = 'id';
      $this->sortDirection     = 'desc';
      $this->perPage           = 10;
      $this->paginationOptions = config('project.pagination.options');
      $this->orderable         = (new User())->orderable;
  }
  
  public function render()
  {
    $query = User::with(['role', 'posts'])->advancedFilter([
        's'               => $this->search ?: null,
        'order_column'    => $this->sortBy,
        'order_direction' => $this->sortDirection,
    ]);

    $users = $query->paginate($this->perPage);

    return view('livewire.admin.users.users-table', compact('query', 'users'));
  }

  public function getSelectedCountProperty()
  {
      return count($this->selected);
  }

  public function updatingSearch()
  {
      $this->resetPage();
  }

  public function updatingPerPage()
  {
      $this->resetPage();
  }

  public function resetSelected()
  {
      $this->selected = [];
  }
}
