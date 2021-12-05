<div>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <form method="get">
          <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4" type="text" placeholder="Search Users" wire:model.debounce.300ms="search"/>
        </form>
        <div wire:loading.delay class="col-12 alert alert-info">
            Loading...
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
                      <td class="px-6 py-4 whitespace-nowrap">{{ $item->posts->first()->title ?? '' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $item->phone }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          {{-- @endif --}}
      
        {{ $users->appends(\Request::except('page'))->render() }}
      </div>
    </div>
  </div>
</div>