@extends('layouts.app')

@section('content')
<div
  class="bg-base-100 flex flex-col rounded-md shadow"
  data-datatable='{
  "pageLength": 5,
  "pagingOptions": {
    "pageBtnClasses": "btn btn-text btn-circle btn-sm"
  },
  "language": {
      "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><span class=\"icon-[tabler--search] shrink-0 size-6 text-base-content/90\"></span><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-base-content/80\">No hay resultados de búsqueda</p></div></div>",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
      "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
      "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    }
}'>
  <div class="py-3 ps-5 border-b border-base-content/25">
    <form method="GET" action="{{ route('admin.usuarios.buscar') }}" class="input-group max-w-[15rem]">
      <span class="input-group-text">
        <span class="icon-[tabler--search] shrink-0 size-4 text-base-content/90"></span>
      </span>
      <label class="sr-only" for="table-input-search"></label>
      <input type="search" name="search" class="input input-sm grow" id="table-input-search" placeholder="Buscar usuarios" value="{{ request('search') }}"/>
    </form>
  </div>
  <div class="horizontal-scrollbar overflow-x-auto">
    <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden">
        <table class="table min-w-full">
          <thead>
            <tr>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Nombre de Usuario
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Nombre
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Primer Apellido
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Segundo Apellido
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Email
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="group w-fit">
                <div class="flex items-center justify-between">
                  Tipo de Usuario
                  <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                  <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                </div>
              </th>
              <th scope="col" class="--exclude-from-ordering">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td class="text-nowrap">{{ $user->username }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->user_type }}</td>
              <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-circle btn-text btn-sm" aria-label="Editar">
                  <span class="icon-[tabler--pencil] size-5"></span>
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-circle btn-text btn-sm" aria-label="Eliminar">
                    <span class="icon-[tabler--trash] size-5"></span>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="border-base-content/25 flex items-center justify-between gap-3 border-t p-3 max-md:flex-wrap max-md:justify-center">
    <div class="flex items-center space-x-1">
      {{ $users->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection
