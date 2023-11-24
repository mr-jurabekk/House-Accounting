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
                    {{ __("You're logged in!") }}

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Type</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sum</th>
                            <th scope="col">Date</th>
                            <th scope="col">Comment</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reports as $key =>  $report)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$report->user->name}}</td>
                                <td>{{$report->type->name}}</td>
                                <td>{{$report->category->name}}</td>
                                <td>{{$report->sum}}</td>
                                <td>{{$report->created_at->format('d-M Y')}}</td>
                                <td>{{$report->comment}}</td>
                            </tr>
                        @endforeach
                        <tr>Jami: </tr>
                        </tbody>

                        {{$reports->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
