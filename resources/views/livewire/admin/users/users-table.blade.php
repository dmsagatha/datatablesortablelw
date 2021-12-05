<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
  @section('title', __("Users"))

  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
      {{ __('List of Users') }}
    </h2>
  </x-slot>

  <x-table.table>
    <div class="flex items-center justify-center text-sm text-gray-500 bg-white px-4 py-6 gap-x-2 border-t border-gray-200 sm:px-6">
      <!-- Buscar -->
      <div class="flex-1 pr-4">
        <div class="relative md:w-2/3">
          <input type="search"
            class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Buscar..." wire:model.debounce.300ms="search">
          <div class="absolute top-0 left-0 inline-flex items-center p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <circle cx="10" cy="10" r="7" />
              <line x1="21" y1="21" x2="15" y2="15" />
            </svg>
          </div>
        </div>
        <div wire:loading.delay class="col-12 alert alert-info">
          {{ __('Loading...') }}
        </div>
      </div>

      <!-- Paginar -->
      <div class="relative inline-flex mr-2">
        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 412 232">
          <path
            d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
            fill="#648299" fill-rule="nonzero" />
        </svg>
        <label for="perPage"
          class="inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">{{ __('Per Page') }}</label>
        <select wire:model="perPage"
          class="border border-gray-300 rounded-lg text-gray-500 h-10 pl-5 pr-10 inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline appearance-none">
          @foreach($paginationOptions as $value)
            <option value="{{ $value }}">{{ $value }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <!-- Paginar, Buscar y Filtros -->

    @if (count($users))
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 text-center text-sm font-bold">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">
              Id
              @include('components.table.sort', ['field' => 'id'])
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              {{ __('Name') }}
              @include('components.table.sort', ['field' => 'name'])
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              {{ __('Email') }}
              @include('components.table.sort', ['field' => 'email'])
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              {{ __('Role') }}
              @include('components.table.sort', ['field' => 'role.name'])
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              {{ __('Post') }}
              @include('components.table.sort', ['field' => 'posts.title'])
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
              {{ __('Phone') }}
              @include('components.table.sort', ['field' => 'phone'])
            </th>
            <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">Editar</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-sm">
          @foreach ($users as $item)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
              <td class="px-6 py-4">{{ $item->name }}</td>
              <td class="px-6 py-4">{{ $item->email }}</td>
              <td class="px-6 py-4">{{ $item->role->name }}</td>
              <td class="px-6 py-4">
                  @foreach($item->posts as $key => $entry)
                    {{ $entry->title }}
                  @endforeach
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $item->phone }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">
                  <i class="fas fa-edit"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @if ($users->hasPages())
        <div class="px-6 py-3">
          {{ $users->links() }}
        </div>
      @endif
    @else
      <div class="px-6 py-4">
        No existen registros coincidentes
      </div>
    @endif
  </x-table.table>
</div>

{{-- <div>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <form method="get">
          <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4" type="text" placeholder="Search Users" wire:model.debounce.300ms="search"/>
        </form>
        <div wire:loading.delay class="col-12 alert alert-info">
          {{ __('Loading') }}...
        </div>
        
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Id
                  @include('components.table.sort', ['field' => 'id'])
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Name') }}
                  @include('components.table.sort', ['field' => 'name'])
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Email') }}
                  @include('components.table.sort', ['field' => 'email'])
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Role') }}
                  @include('components.table.sort', ['field' => 'role.name'])
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Post') }}
                  @include('components.table.sort', ['field' => 'posts.title'])
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                  {{ __('Phone') }}
                  @include('components.table.sort', ['field' => 'phone'])
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Editar</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($users as $item)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->email }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->role->name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @foreach($item->posts as $key => $entry)
                      {{ $entry->title }}
                    @endforeach
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->phone }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      
        {{ $users->appends(\Request::except('page'))->render() }}
      </div>
    </div>
  </div>
</div> --}}