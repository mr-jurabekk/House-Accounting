<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div>


                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="nav-item active">
                                <a class="nav-link" href="#home" aria-controls="home" role="tab" data-toggle="tab">Все
                                    Истории</a>
                            </li>

                            <li role="presentation">
                                <a class="nav-link text-danger" href="{{route('reports.create')}}">Back</a>
                            </li>
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User</th>
                                        <th scope="col">ТИП</th>
                                        <th class="category" scope="col">КАТЕГОРИЯ</th>
                                        <th scope="col">СУММА</th>
                                        <th scope="col">ДАТА</th>
                                        <th scope="col">КОММЕНТАРИЙ</th>
                                        <th scope="col">
                                            <form action="{{route('delete')}}" method="POST"
                                                  onsubmit="return confirm('Вы уверены, что хотите удалить всю историю?')">
                                                @csrf

                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                            </form>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr>
                                        <div class="d-flex justify-end my-3">
                                            <div>
                                                <b>Этот месяц:</b>
                                            </div>
                                            <div class="text-success mx-3">
                                                Доход -> {{formatCurrency($debit)}}
                                            </div>
                                            <div class="text-danger">
                                                Расход -> {{formatCurrency($credit)}}
                                            </div>
                                        </div>

                                        <div class="d-flex justify-end my-3">
                                            <div>
                                                <b>Итого:</b>
                                            </div>
                                            <div class="text-success mx-3">
                                                Доход -> {{formatCurrency($salary)}}
                                            </div>
                                            <div class="text-danger">
                                                Расход -> {{formatCurrency($expenses)}}
                                            </div>
                                        </div>
                                    </tr>

                                    @foreach($reports as $key => $report)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$report->user->name}}</td>
                                            <td>
                                                @if($report->type->name === 'Доход')
                                                    <p class="p-1 m-0 rounded text-center btn-success">{{$report->type->name}}</p>
                                                @else
                                                    <p class="p-1 m-0 rounded text-center btn-danger">{{$report->type->name}}</p>
                                                @endif
                                            </td>
                                            <td>{{$report->category->name}}</td>
                                            <td>{{formatCurrency($report->sum)}}</td>
                                            <td>{{$report->date->format('d.m.Y')}}</td>
                                            <td>{{$report->comment}}</td>
                                            <td>
                                                <form action="{{route('reports.destroy', ['report' => $report->id])}}"
                                                      method="POST"
                                                      onsubmit="return confirm('Вы уверены, что хотите удалить?')">
                                                    @csrf
                                                    @method('Delete')

                                                        <button class="btn btn-warning" type="submit">
                                                            <i class="fa-solid fa-trash-can"></i>
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


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
