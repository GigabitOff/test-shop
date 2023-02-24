<x-testing-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Страница тестовых сервисных функций</h1>
            </div>
            <div class="col-12">
                <p>Доступна только для админа и только на среде разработки</p>
            </div>
        </div>

        <div class="row mt-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-10">
                            <p>Проверка действия "Деактивация просроченных Акций" имитация работы крона </p>
                            <p class="text-secondary">Результатом работы будет установка свойства <span class="fst-italic font-monospace px-1">status</span> в таблице <span class="fst-italic font-monospace px-1">actions</span> для всех просроченных записей</p>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-primary" href="{{route('testing.promotions.deactivate')}}" role="button">Запуск</a>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">blank</li>
            </ul>
        </div>
    </div>
</x-testing-layout>
