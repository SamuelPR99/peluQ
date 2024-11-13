<x-layout-error>

@section('title', __('Prohibido'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Prohibido'))
</x-layout-error>