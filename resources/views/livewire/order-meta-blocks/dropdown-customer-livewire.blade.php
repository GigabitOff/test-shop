<div>
    @include('livewire.includes.dropdown-server-filterable', [
        'name' => 'filterableCustomer',
        'model' => $filterableCustomer,
        'mode' => $filterableMode,
        'class' => 'custome-dropdown--arrow --empty lk-table-select cart-filterable',
        'placeholder' => __('custom::site.client'),
    ])

    <script>
        document.addEventListener('showAddNewCustomerModal', function (e) {

            const managerId = e.detail.managerId;

            document.lazyWireModal.uploadAndShow('modal-customer-create', {
                'force': true,
                payload: {manager_id: managerId}
            })
        })
    </script>
</div>
