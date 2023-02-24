<x-testing-layout>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary p-2" href="{{route('testing.index')}}" role="button">Назад</a>
            <a class="btn btn-primary p-2" href="{{request()->url()}}" role="button">Обновить</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <h3 class="py-3">Ответ</h3>
            <p>{!! $message !!}}</p>
        </div>
    </div>
</x-testing-layout>
