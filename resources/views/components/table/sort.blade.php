@if(in_array($field, $orderable))
  @if($sortBy !== $field)
    <i wire:click="sortBy('{{ $field }}')" class="fa fa-fw fa-sort float-right mt-1 text-muted" aria-hidden="true"></i>
  @elseif($sortBy === $field && $sortDirection == 'desc')
    <i wire:click="sortBy('{{ $field }}')" class="fa fa-fw fa-sort-alpha-down-alt float-right mt-1  text-blue-500" aria-hidden="true"></i>
  @else
    <i wire:click="sortBy('{{ $field }}')" class="fa fa-fw fa-sort-alpha-up-alt float-right mt-1  text-blue-500" aria-hidden="true"></i>
  @endif
@endif