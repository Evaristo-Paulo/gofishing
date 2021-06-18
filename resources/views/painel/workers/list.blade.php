@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Listagem de Funcionários</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table hover multiple-select-row nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Bilhete de Identidade</th>
                            <th>Gênero</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th>Área Funcional</th>
                            <th>Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $workers as $worker )
                            <tr>
                                <td class="table-plus">
                                    <div class="name-avatar d-flex align-items-center">
						    			<div class="avatar mr-2 flex-shrink-0">
						    				<img src="{{ url("storage/people/". $worker->photo. "") }}" class="border-radius-100 shadow" width="40" height="40" alt="">
						    			</div>
						    			<div class="txt">
						    				<div class="weight-600">{{ $worker->name }}</div>
						    			</div>
						    		</div>
                                </td>
                                <td>{{ $worker->birthday }}</td>
                                <td>{{ $worker->bi }}</td>
                                <td>{{ $worker->gender }}</td>
                                <td>{{ $worker->phone }}</td>
                                <td>{{ $worker->email }}</td>
                                <td>{{ $worker->adress }}</td>
                                <td>{{ $worker->ocupation }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('painel.workers.update', encrypt($worker->id) ) }}" data-color="#265ed7" ><i class="icon-copy dw dw-edit2"></i></a>
                                       @if ( Auth::user()->people_id == $worker->id )
                                       <a href="javascript:void(0)" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                       @else
                                       <a href="{{ route('painel.users.remove', encrypt($worker->id) ) }}" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                       @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- multiple select row Datatable End -->
    
    </div>
</div>

@endsection

@push('css')

<link rel="stylesheet" type="text/css" href="{{  asset('painel/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('painel/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('painel/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Datatable Setting js -->
<script src="{{ asset('painel/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
