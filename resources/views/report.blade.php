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
                                <a class="nav-link" href="#home" aria-controls="home" role="tab" data-toggle="tab">Расход</a>
                            </li>
                            <li role="presentation">
                                <a class="nav-link" href="#profile" aria-controls="profile" role="tab"
                                   data-toggle="tab">Доход</a>
                            </li>
                            <li role="presentation">
                                <a class="nav-link" href="#messages" aria-controls="messages" role="tab"
                                   data-toggle="tab">Мои Истории</a>
                            </li>
                            @if(auth()->user()->role->name == 'mother')
                                <li role="presentation">
                                    <a class="nav-link" href="#settings" aria-controls="settings" role="tab"
                                       data-toggle="tab">Все Истории</a>
                                </li>
                            @elseif(auth()->user()->role->name == 'father')
                                <li role="presentation">
                                    <a class="nav-link" href="{{route('reports.index')}}">Все</a>
                                </li>
                            @endif
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <form action="{{route('reports.store')}}" method="POST">
                                    @csrf
                                    <div class="my-3">
                                        <input type="hidden" name="type_id" value="2">
                                    </div>
                                    <div class="my-3">
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="sum" class="form-control"
                                               aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-text">sum</span>
                                    </div>
                                    @error('sum')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Date</span>
                                        <input type="datetime-local" name="time" class="form-control"
                                               aria-label="Amount (to the nearest dollar)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Example
                                            textarea</label>
                                        <textarea class="form-control" name="comment" id="exampleFormControlTextarea1"
                                                  rows="3"></textarea>
                                    </div>
                                    @error('comment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="my-3">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <form action="{{route('reports.store')}}" method="POST">
                                    @csrf
                                    <div class="my-3">
                                        <input type="hidden" name="type_id" value="1">
                                    </div>
                                    <div class="my-3">
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            @foreach($category2 as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="sum" class="form-control"
                                               aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-text">sum</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Date</span>
                                        <input type="datetime-local" name="time" class="form-control"
                                               aria-label="Amount (to the nearest dollar)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Example
                                            textarea</label>
                                        <textarea class="form-control" name="comment" id="exampleFormControlTextarea1"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="my-3">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ТИП</th>
                                        <th scope="col">КАТЕГОРИЯ</th>
                                        <th scope="col">СУММА</th>
                                        <th scope="col">ДАТА</th>
                                        <th scope="col">КОММЕНТАРИЙ</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($histories as $key =>  $history)


                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>
                                                @if($history->type->name === 'Доход')
                                                    <p class="p-1 m-0 rounded text-center btn-success">{{$history->type->name}}</p>
                                                @else
                                                    <p class="p-1 m-0 rounded text-center btn-danger">{{$history->type->name}}</p>
                                                @endif
                                            </td>
                                            <td>{{$history->category->name}}</td>
                                            <td>{{formatCurrency($history->sum)}}</td>
                                            <td>{{$history->date->format('d.m.Y')}}</td>
                                            <td>{{$history->comment}}</td>
                                        </tr>

                                    @endforeach
                                    <tr>
                                        <div class="d-flex justify-end my-3">
                                            <div>
                                                <b>Итого:</b>
                                            </div>
                                            <div class="text-success mx-3">
                                                Доход -> {{formatCurrency($my_salary)}}
                                            </div>
                                            <div class="text-danger">
                                                Расход -> {{formatCurrency($my_exp)}}
                                            </div>
                                        </div>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            @if(auth()->user()->role->name == 'mother' )
                                <div role="tabpanel" class="tab-pane" id="settings">
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
                                        </tr>
                                        </thead>
                                        <tbody>

                                       @if(auth()->user()->role->name == 'mother')
                                            @foreach($child_reports as $key =>  $report)
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
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="all">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Doxod</th>
                                            <th scope="col">Rasxod</th>
                                            <th scope="col">Summa</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                       @if(auth()->user()->role->name == 'mother')
                                            @foreach($child_reports as $key =>  $report)
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
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                            @endif


                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
